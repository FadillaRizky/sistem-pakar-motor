<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Rule;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'gejala'     => Gejala::count(),
            'kerusakan'  => Kerusakan::count(),
            'rule'       => Rule::count(),
            'user'       => User::count(),
        ]);
    }
}
