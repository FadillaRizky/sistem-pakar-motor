<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the rules.
     */
    public function index()
    {
        $rules = Rule::with('kerusakan')->latest()->paginate(10);
        $gejalas = \App\Models\Gejala::all();

        return view('rule.index', compact('rules', 'gejalas'));
    }

    /**
     * Show the form for creating a new rule.
     */
    public function create()
    {
        $gejalas = Gejala::all();
        $kerusakans = Kerusakan::all();

        return view('rule.create', compact('gejalas', 'kerusakans'));
    }

    /**
     * Store a newly created rule in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kerusakan_id' => 'required|exists:kerusakans,id',
            'gejala_ids' => 'required|array|min:1',
            'gejala_ids.*' => 'exists:gejalas,id',
            'certainty_factor' => 'required|numeric|min:0|max:1'
        ], [
            'kerusakan_id.required' => 'Pilih kerusakan terlebih dahulu',
            'kerusakan_id.exists' => 'Kerusakan tidak valid',
            'gejala_ids.required' => 'Pilih minimal satu gejala',
            'gejala_ids.min' => 'Pilih minimal satu gejala',
            'gejala_ids.*.exists' => 'Ada gejala yang tidak valid',
            'certainty_factor.required' => 'Masukkan nilai Certainty Factor',
            'certainty_factor.numeric' => 'Certainty Factor harus berupa angka',
            'certainty_factor.min' => 'Certainty Factor minimal 0',
            'certainty_factor.max' => 'Certainty Factor maksimal 1'
        ]);

        // Convert array ke JSON
        $validated['gejala_ids'] = json_encode($validated['gejala_ids']);

        Rule::create($validated);

        return redirect()->route('rule.index')
                        ->with('success', 'Rule berhasil ditambahkan!');
    }

    /**
     * Display the specified rule.
     */
    public function show(Rule $rule)
    {
        $rule->load('kerusakan');
        $gejalas = Gejala::all();

        return view('rule.show', compact('rule', 'gejalas'));
    }

    /**
     * Show the form for editing the specified rule.
     */
    public function edit(Rule $rule)
    {
        $rule->load('kerusakan');
        $gejalas = Gejala::all();
        $kerusakans = Kerusakan::all();

        // Convert gejala_ids dari JSON ke array jika perlu
        if (is_string($rule->gejala_ids)) {
            $rule->gejala_ids = json_decode($rule->gejala_ids, true);
        }

        return view('rule.edit', compact('rule', 'gejalas', 'kerusakans'));
    }

    /**
     * Update the specified rule in storage.
     */
    public function update(Request $request, Rule $rule)
    {
        $validated = $request->validate([
            'kerusakan_id' => 'required|exists:kerusakans,id',
            'gejala_ids' => 'required|array|min:1',
            'gejala_ids.*' => 'exists:gejalas,id',
            'certainty_factor' => 'required|numeric|min:0|max:1'
        ], [
            'kerusakan_id.required' => 'Pilih kerusakan terlebih dahulu',
            'kerusakan_id.exists' => 'Kerusakan tidak valid',
            'gejala_ids.required' => 'Pilih minimal satu gejala',
            'gejala_ids.min' => 'Pilih minimal satu gejala',
            'gejala_ids.*.exists' => 'Ada gejala yang tidak valid',
            'certainty_factor.required' => 'Masukkan nilai Certainty Factor',
            'certainty_factor.numeric' => 'Certainty Factor harus berupa angka',
            'certainty_factor.min' => 'Certainty Factor minimal 0',
            'certainty_factor.max' => 'Certainty Factor maksimal 1'
        ]);

        // Convert array ke JSON
        $validated['gejala_ids'] = json_encode($validated['gejala_ids']);

        $rule->update($validated);

        return redirect()->route('rule.index')
                        ->with('success', 'Rule berhasil diperbarui!');
    }

    /**
     * Remove the specified rule from storage.
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();

        return redirect()->route('rule.index')
                        ->with('success', 'Rule berhasil dihapus!');
    }
}
