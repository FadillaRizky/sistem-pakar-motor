<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    // HALAMAN KONSULTASI (USER)
    public function index()
    {
        $gejalas = Gejala::all();
        // arahkan ke view user
        return view('user.konsultasi', compact('gejalas'));
    }

    // PROSES DIAGNOSA (USER)
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
