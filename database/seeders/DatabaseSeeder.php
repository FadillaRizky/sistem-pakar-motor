<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed data dalam urutan yang benar
        $this->call([
            GejalaSeeder::class,
            KerusakanSeeder::class,
            RuleSeeder::class,
        ]);
    }
}
