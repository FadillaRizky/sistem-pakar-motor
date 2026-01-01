<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rules';
    protected $guarded = [];
    protected $fillable = [
        'kerusakan_id',
        'gejala_ids',
        'certainty_factor'
    ];

    // Cast gejala_ids dari JSON ke array
    protected $casts = [
        'gejala_ids' => 'array',
        'certainty_factor' => 'float'
    ];

    // Relasi dengan Kerusakan
    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class, 'kerusakan_id');
    }

    // Relasi dengan Gejala melalui rule_gejala
    public function gejalas()
    {
        return $this->belongsToMany(Gejala::class, 'rule_gejala', 'rule_id', 'gejala_id');
    }
}
