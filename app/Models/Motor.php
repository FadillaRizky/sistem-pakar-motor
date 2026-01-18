<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $fillable = [
        'nama_motor',
        'merk',
        'tipe',
        'transmisi',
        'deskripsi',
        'gambar',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Scope untuk mengambil motor yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
