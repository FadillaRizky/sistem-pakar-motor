<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasis';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'kerusakan_id',
        'confidence',
        'gejala_dipilih'
    ];

    protected $casts = [
        'gejala_dipilih' => 'array',
        'confidence' => 'float'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Kerusakan
    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class);
    }
}
