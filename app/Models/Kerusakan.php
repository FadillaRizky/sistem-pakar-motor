<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kerusakan extends Model
{
    use HasFactory;

    protected $table = 'kerusakans';
    protected $guarded = [];
    protected $fillable = [
        'kode_kerusakan',
        'nama_kerusakan',
        'deskripsi',
        'solusi'
    ];

    // Relasi dengan Rule
    public function rules()
    {
        return $this->hasMany(Rule::class, 'kerusakan_id');
    }
}
