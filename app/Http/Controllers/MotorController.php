<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motors = Motor::latest()->paginate(10);
        return view('motor.index', compact('motors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('motor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tipe' => 'nullable|string|max:255',
            'transmisi' => 'required|in:matic,manual',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama_motor.required' => 'Nama motor wajib diisi',
            'merk.required' => 'Merk motor wajib diisi',
            'transmisi.required' => 'Jenis transmisi wajib dipilih',
            'transmisi.in' => 'Transmisi harus matic atau manual',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/motor'), $filename);
            $data['gambar'] = $filename;
        }

        $data['is_active'] = $request->has('is_active');

        Motor::create($data);

        return redirect()->route('motor.index')
            ->with('success', 'Data motor berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motor $motor)
    {
        return view('motor.edit', compact('motor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motor $motor)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tipe' => 'nullable|string|max:255',
            'transmisi' => 'required|in:matic,manual',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama_motor.required' => 'Nama motor wajib diisi',
            'merk.required' => 'Merk motor wajib diisi',
            'transmisi.required' => 'Jenis transmisi wajib dipilih',
            'transmisi.in' => 'Transmisi harus matic atau manual',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($motor->gambar && file_exists(public_path('uploads/motor/' . $motor->gambar))) {
                unlink(public_path('uploads/motor/' . $motor->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/motor'), $filename);
            $data['gambar'] = $filename;
        }

        $data['is_active'] = $request->has('is_active');

        $motor->update($data);

        return redirect()->route('motor.index')
            ->with('success', 'Data motor berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motor $motor)
    {
        // Hapus gambar jika ada
        if ($motor->gambar && file_exists(public_path('uploads/motor/' . $motor->gambar))) {
            unlink(public_path('uploads/motor/' . $motor->gambar));
        }

        $motor->delete();

        return redirect()->route('motor.index')
            ->with('success', 'Data motor berhasil dihapus');
    }
}
