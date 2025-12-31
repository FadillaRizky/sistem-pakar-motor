<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class RuleController extends Controller
{
public function index()
{
    $rules = Rule::with('kerusakan')->get();

    // ⬇️ INI KUNCI UTAMA
    $gejalas = Gejala::all()->keyBy('id');

    return view('rule.index', compact('rules', 'gejalas'));
}


    public function create()
{
    $kerusakans = Kerusakan::all();
    $gejalas = Gejala::all();

    return view('rule.create', compact('kerusakans', 'gejalas'));
}

    public function store(Request $request)
    {
        $request->validate([
            'kerusakan_id' => 'required',
            'gejala_ids' => 'required|array'
        ]);

        Rule::create([
    'kerusakan_id' => $request->kerusakan_id,
    'gejala_ids'   => $request->gejala_ids, // ARRAY
]);


        return redirect()->route('rule.index')->with('success', 'Rule berhasil ditambahkan');
    }

    public function edit(Rule $rule)
    {
        $gejalas = Gejala::all();
        $kerusakans = Kerusakan::all();
        return view('rule.edit', compact('rule', 'gejalas', 'kerusakans'));
    }

    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'kerusakan_id' => 'required',
            'gejala_ids' => 'required|array'
        ]);

        $rule->update([
            'kerusakan_id' => $request->kerusakan_id,
            'gejala_ids' => $request->gejala_ids
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule berhasil diperbarui');
    }

    public function destroy(Rule $rule)
    {
        $rule->delete();
        return redirect()->route('rule.index')->with('success', 'Rule berhasil dihapus');
    }
}
