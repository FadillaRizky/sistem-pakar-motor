<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        // Rule 1: Baterai Lemah (K001)
        // Gejala: Mesin tidak bisa dihidupkan (G001), Baterai Lemah (G007), Koil Rusak (G008)
        Rule::create([
            'kerusakan_id' => 1, // K001 - Baterai Lemah
            'gejala_ids' => json_encode([1, 7]), // G001, G007
            'certainty_factor' => 0.95
        ]);

        // Rule 2: Koil Rusak (K002)
        Rule::create([
            'kerusakan_id' => 2, // K002 - Koil Rusak
            'gejala_ids' => json_encode([1, 3, 8]), // G001, G003, G008
            'certainty_factor' => 0.90
        ]);

        // Rule 3: Busi Kotor/Rusak (K003)
        Rule::create([
            'kerusakan_id' => 3, // K003 - Busi Kotor/Rusak
            'gejala_ids' => json_encode([2, 3]), // G002, G003
            'certainty_factor' => 0.85
        ]);

        // Rule 4: Karburator Tersumbat (K004)
        Rule::create([
            'kerusakan_id' => 4, // K004 - Karburator Tersumbat
            'gejala_ids' => json_encode([2, 4, 9]), // G002, G004, G009
            'certainty_factor' => 0.88
        ]);

        // Rule 5: Sistem Pendingin Tidak Berfungsi (K005)
        Rule::create([
            'kerusakan_id' => 5, // K005 - Sistem Pendingin
            'gejala_ids' => json_encode([2, 6]), // G002, G006
            'certainty_factor' => 0.92
        ]);

        // Rule 6: Seal Oli Bocor (K006)
        Rule::create([
            'kerusakan_id' => 6, // K006 - Seal Oli Bocor
            'gejala_ids' => json_encode([5, 6]), // G005, G006
            'certainty_factor' => 0.89
        ]);

        // Rule 7: Filter Udara Kotor (K007)
        Rule::create([
            'kerusakan_id' => 7, // K007 - Filter Udara Kotor
            'gejala_ids' => json_encode([9, 10]), // G009, G010
            'certainty_factor' => 0.91
        ]);

        // Rule 8: Piston Aus (K008)
        Rule::create([
            'kerusakan_id' => 8, // K008 - Piston Aus
            'gejala_ids' => json_encode([2, 5, 6]), // G002, G005, G006
            'certainty_factor' => 0.87
        ]);

        // Rule 9: Rantai Motor Longgar (K009)
        Rule::create([
            'kerusakan_id' => 9, // K009 - Rantai Motor Longgar
            'gejala_ids' => json_encode([2, 11]), // G002, G011
            'certainty_factor' => 0.93
        ]);

        // Rule 10: Kampas Rem Aus (K010)
        Rule::create([
            'kerusakan_id' => 10, // K010 - Kampas Rem Aus
            'gejala_ids' => json_encode([12]), // G012
            'certainty_factor' => 0.96
        ]);
    }
}
