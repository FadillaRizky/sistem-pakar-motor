<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gejala extends Model
{
    use HasFactory;

    protected $table = 'gejalas';
    protected $guarded = [];
    protected $fillable = [
        'kode_gejala',
        'nama_gejala',
        'deskripsi'
    ];

    // Relasi dengan Rule melalui rule_gejala
    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'rule_gejala', 'gejala_id', 'rule_id');
    }
}
