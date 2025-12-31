<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    protected $fillable = [
        'kode_kerusakan',
        'nama_kerusakan',
        'solusi'
    ];
}

