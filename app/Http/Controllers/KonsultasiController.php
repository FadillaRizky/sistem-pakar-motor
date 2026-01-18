<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    // HALAMAN KONSULTASI PUBLIC (TANPA LOGIN)
    public function indexPublic()
    {
        $gejalas = Gejala::all();
        $motors = \App\Models\Motor::active()->get();
        return view('konsultasi.public', compact('gejalas', 'motors'));
    }

    // PROSES DIAGNOSA PUBLIC (TANPA LOGIN)
    public function prosesPublic(Request $request)
    {
        $request->validate([
            'motor_id' => 'nullable|exists:motors,id',
            'gejala_ids' => 'required|array|min:1'
        ], [
            'motor_id.exists' => 'Motor tidak valid',
            'gejala_ids.required' => 'Silakan pilih minimal satu gejala.',
            'gejala_ids.min'      => 'Silakan pilih minimal satu gejala.',
        ]);

        $userGejala = $request->gejala_ids;
        $jumlahGejalaDipilih = count($userGejala);
        $selectedMotor = $request->motor_id ? \App\Models\Motor::find($request->motor_id) : null;

        $rules = Rule::with('kerusakan')->get();
        $hasilDiagnosa = [];

        foreach ($rules as $rule) {
            $ruleGejala = is_array($rule->gejala_ids)
                ? $rule->gejala_ids
                : json_decode($rule->gejala_ids, true);

            $cocok = array_intersect($ruleGejala, $userGejala);
            $jumlahCocok = count($cocok);
            $persentase = $jumlahCocok / count($ruleGejala) * 100;

            if ($jumlahCocok > 0) {
                $hasilDiagnosa[] = [
                    'kerusakan' => $rule->kerusakan,
                    'persentase' => $persentase,
                    'gejala_cocok' => $cocok,
                    'jumlah_cocok' => $jumlahCocok,
                    'total_gejala_rule' => count($ruleGejala),
                    'certainty_factor' => $rule->certainty_factor ?? 0.5
                ];
            }
        }

        // Sort berdasarkan persentase tertinggi
        usort($hasilDiagnosa, function($a, $b) {
            return $b['persentase'] <=> $a['persentase'];
        });

        $hasil = $hasilDiagnosa[0]['kerusakan'] ?? null;
        $persentase = $hasilDiagnosa[0]['persentase'] ?? 0;
        $gejalaCocok = $hasilDiagnosa[0]['gejala_cocok'] ?? [];
        $certaintyFactor = $hasilDiagnosa[0]['certainty_factor'] ?? 0;

        return view('konsultasi.hasil-public', compact(
            'hasil',
            'persentase',
            'userGejala',
            'jumlahGejalaDipilih',
            'gejalaCocok',
            'hasilDiagnosa',
            'certaintyFactor',
            'selectedMotor'
        ));
    }

    // HALAMAN KONSULTASI (USER LOGIN)
    public function index()
    {
        $gejalas = Gejala::all();
        // arahkan ke view user
        return view('user.konsultasi', compact('gejalas'));
    }

    // PROSES DIAGNOSA (USER LOGIN)
    public function proses(Request $request)
    {
        $request->validate([
            'gejala_ids' => 'required|array|min:1'
        ], [
            'gejala_ids.required' => 'Silakan pilih minimal satu gejala.',
            'gejala_ids.min'      => 'Silakan pilih minimal satu gejala.',
        ]);

        $userGejala = $request->gejala_ids;
        $jumlahGejalaDipilih = count($userGejala);

        $rules = Rule::all();
        $hasil = null;
        $persentase = 0;
        $gejalaCocok = [];

        foreach ($rules as $rule) {
            $ruleGejala = is_array($rule->gejala_ids)
                ? $rule->gejala_ids
                : json_decode($rule->gejala_ids, true);

            $cocok = array_intersect($ruleGejala, $userGejala);
            $jumlahCocok = count($cocok);
            $nilai = $jumlahCocok / count($ruleGejala) * 100;

            if ($nilai > $persentase) {
                $persentase = $nilai;
                $hasil = Kerusakan::find($rule->kerusakan_id);
                $gejalaCocok = $cocok;
            }
        }

        return view('konsultasi.hasil', compact(
            'hasil',
            'persentase',
            'userGejala',
            'jumlahGejalaDipilih',
            'gejalaCocok'
        ));
    }
}
