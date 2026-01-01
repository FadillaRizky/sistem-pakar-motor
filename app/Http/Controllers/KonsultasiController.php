<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Kerusakan;
use App\Models\Konsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * HALAMAN KONSULTASI - Tampilkan daftar gejala
     */
    public function index()
    {
        $gejalas = Gejala::all();
        return view('konsultasi.index', compact('gejalas'));
    }

    /**
     * PROSES DIAGNOSA - Forward Chaining
     */
    public function proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'gejala_ids' => 'required|array|min:1'
        ], [
            'gejala_ids.required' => 'Silakan pilih minimal satu gejala',
            'gejala_ids.min' => 'Silakan pilih minimal satu gejala'
        ]);

        $userGejala = array_map('intval', $request->gejala_ids); // Konversi ke integer

        // Ambil semua rule
        $rules = Rule::all();
        $hasilDiagnosa = [];

        // Forward Chaining: Hitung confidence untuk setiap rule
        foreach ($rules as $rule) {
            // Decode JSON ke array (penting!)
            $ruleGejala = is_array($rule->gejala_ids) ? $rule->gejala_ids : json_decode($rule->gejala_ids, true);

            // Pastikan array valid
            if (!is_array($ruleGejala)) {
                continue;
            }

            // Hitung berapa gejala yang cocok dengan rule
            $gejalaYangCocok = array_intersect($ruleGejala, $userGejala);
            $jumlahCocok = count($gejalaYangCocok);
            $jumlahRule = count($ruleGejala);

            // Hitung persentase kecocokkan (confidence)
            if ($jumlahRule > 0) {
                $persentaseKecocokkan = ($jumlahCocok / $jumlahRule) * 100;

                // Kalikan dengan certainty factor dari rule
                $confidence = ($persentaseKecocokkan / 100) * $rule->certainty_factor;

                // Simpan hasil jika ada gejala yang cocok
                if ($jumlahCocok > 0) {
                    $kerusakan = Kerusakan::find($rule->kerusakan_id);

                    if ($kerusakan) {
                        $hasilDiagnosa[] = [
                            'kerusakan_id' => $rule->kerusakan_id,
                            'nama_kerusakan' => $kerusakan->nama_kerusakan,
                            'deskripsi' => $kerusakan->deskripsi,
                            'solusi' => $kerusakan->solusi,
                            'confidence' => round($confidence * 100, 2),
                            'gejala_cocok' => $jumlahCocok,
                            'total_gejala_rule' => $jumlahRule
                        ];
                    }
                }
            }
        }

        // Urutkan berdasarkan confidence (tertinggi dulu)
        usort($hasilDiagnosa, function($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        // Ambil hasil top (confidence tertinggi)
        $hasilTop = !empty($hasilDiagnosa) ? $hasilDiagnosa[0] : null;

        // Simpan ke database (opsional)
        if ($hasilTop) {
            Konsultasi::create([
                'user_id' => auth()->id(),
                'kerusakan_id' => $hasilTop['kerusakan_id'],
                'gejala_dipilih' => $userGejala,
                'confidence' => $hasilTop['confidence']
            ]);
        }

        return view('konsultasi.hasil', [
            'hasilTop' => $hasilTop,
            'semuaHasil' => $hasilDiagnosa,
            'gejalaYangDipilih' => $userGejala,
            'jumlahGejalaDipilih' => count($userGejala)
        ]);
    }
}
