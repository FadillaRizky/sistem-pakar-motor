<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        $gejalas = [
            ['kode_gejala' => 'G001', 'nama_gejala' => 'Mesin Tidak Bisa Dihidupkan', 'deskripsi' => 'Motor tidak bisa dinyalakan sama sekali'],
            ['kode_gejala' => 'G002', 'nama_gejala' => 'Mesin Mogok Saat Berjalan', 'deskripsi' => 'Motor tiba-tiba mati saat dijalankan'],
            ['kode_gejala' => 'G003', 'nama_gejala' => 'Busi Menyala Lemah', 'deskripsi' => 'Percikan api pada busi tidak kuat'],
            ['kode_gejala' => 'G004', 'nama_gejala' => 'Bensin Bocor dari Karburator', 'deskripsi' => 'Bahan bakar keluar dari karburator'],
            ['kode_gejala' => 'G005', 'nama_gejala' => 'Oli Berkurang', 'deskripsi' => 'Oli mesin terus berkurang meskipun baru diganti'],
            ['kode_gejala' => 'G006', 'nama_gejala' => 'Mesin Panas Berlebihan', 'deskripsi' => 'Suhu mesin melebihi normal'],
            ['kode_gejala' => 'G007', 'nama_gejala' => 'Baterai Lemah', 'deskripsi' => 'Baterai tidak mampu menghidupkan motor'],
            ['kode_gejala' => 'G008', 'nama_gejala' => 'Koil Rusak', 'deskripsi' => 'Koil tidak menghasilkan tegangan'],
            ['kode_gejala' => 'G009', 'nama_gejala' => 'Filter Udara Kotor', 'deskripsi' => 'Filter udara penuh dengan debu'],
            ['kode_gejala' => 'G010', 'nama_gejala' => 'Knalpot Mengeluarkan Asap Berlebihan', 'deskripsi' => 'Asap keluar terlalu banyak dari knalpot'],
            ['kode_gejala' => 'G011', 'nama_gejala' => 'Rantai Motor Melompat', 'deskripsi' => 'Rantai melompat saat motor berjalan'],
            ['kode_gejala' => 'G012', 'nama_gejala' => 'Rem Tidak Responsif', 'deskripsi' => 'Rem tidak berfungsi dengan baik'],
            ['kode_gejala' => 'G013', 'nama_gejala' => 'Ban Kempes', 'deskripsi' => 'Ban tidak memiliki angin yang cukup'],
            ['kode_gejala' => 'G014', 'nama_gejala' => 'Piston Mati', 'deskripsi' => 'Piston tidak bergerak'],
            ['kode_gejala' => 'G015', 'nama_gejala' => 'Knalpot Penyok', 'deskripsi' => 'Knalpot mengalami kerusakan fisik'],
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
