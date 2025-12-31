<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Rule extends Model
{
    protected $fillable = [
        'kerusakan_id',
        'gejala_ids',
    ];

    protected $casts = [
    'gejala_ids' => 'array',
];


    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class);
    }
}


