<?php

namespace Database\Seeders;

use App\Models\Kerusakan;
use Illuminate\Database\Seeder;

class KerusakanSeeder extends Seeder
{
    public function run(): void
    {
        $kerusakans = [
            [
                'kode_kerusakan' => 'K001',
                'nama_kerusakan' => 'Baterai Lemah',
                'deskripsi' => 'Baterai motor tidak mampu menghidupkan mesin',
                'solusi' => 'Ganti baterai dengan yang baru atau charge baterai ke tukang service'
            ],
            [
                'kode_kerusakan' => 'K002',
                'nama_kerusakan' => 'Koil Rusak',
                'deskripsi' => 'Koil tidak dapat menghasilkan tegangan untuk busi',
                'solusi' => 'Ganti koil dengan yang baru di bengkel resmi'
            ],
            [
                'kode_kerusakan' => 'K003',
                'nama_kerusakan' => 'Busi Kotor/Rusak',
                'deskripsi' => 'Busi tidak dapat menghasilkan percikan api',
                'solusi' => 'Bersihkan atau ganti busi dengan yang baru'
            ],
            [
                'kode_kerusakan' => 'K004',
                'nama_kerusakan' => 'Karburator Tersumbat',
                'deskripsi' => 'Bensin tidak dapat mengalir dengan lancar',
                'solusi' => 'Buka karburator dan bersihkan saringan bensin'
            ],
            [
                'kode_kerusakan' => 'K005',
                'nama_kerusakan' => 'Sistem Pendingin Tidak Berfungsi',
                'deskripsi' => 'Mesin panas berlebihan karena pendingin tidak bekerja',
                'solusi' => 'Periksa radiator dan bersihkan, ganti coolant jika perlu'
            ],
            [
                'kode_kerusakan' => 'K006',
                'nama_kerusakan' => 'Seal Oli Bocor',
                'deskripsi' => 'Oli mesin bocor dari seal',
                'solusi' => 'Ganti seal oli dengan yang baru di bengkel'
            ],
            [
                'kode_kerusakan' => 'K007',
                'nama_kerusakan' => 'Filter Udara Kotor',
                'deskripsi' => 'Filter udara penuh debu dan menghambat aliran udara',
                'solusi' => 'Bersihkan atau ganti filter udara'
            ],
            [
                'kode_kerusakan' => 'K008',
                'nama_kerusakan' => 'Piston Aus',
                'deskripsi' => 'Piston mengalami keausan dan tidak berfungsi optimal',
                'solusi' => 'Ganti piston di bengkel dengan teknisi berpengalaman'
            ],
            [
                'kode_kerusakan' => 'K009',
                'nama_kerusakan' => 'Rantai Motor Longgar',
                'deskripsi' => 'Rantai motor terlalu longgar dan sering melompat',
                'solusi' => 'Kencangkan rantai motor atau ganti jika sudah rusak'
            ],
            [
                'kode_kerusakan' => 'K010',
                'nama_kerusakan' => 'Kampas Rem Aus',
                'deskripsi' => 'Kampas rem sudah habis dan perlu diganti',
                'solusi' => 'Ganti kampas rem dengan yang baru'
            ],
        ];

        foreach ($kerusakans as $kerusakan) {
            Kerusakan::create($kerusakan);
        }
    }
}
