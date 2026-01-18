<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::latest()->take(5)->get();
        $kerusakans = Kerusakan::latest()->take(5)->get();
        $rules = Rule::with(['kerusakan'])->latest()->take(5)->get();

        return view('dashboard', compact('gejalas', 'kerusakans', 'rules'));
    }
}
