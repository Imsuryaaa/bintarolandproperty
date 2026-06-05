<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KprPromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\KprPromo::create([
            'nama' => 'BNI Griya Fixed 3 Tahun',
            'bunga_fix' => 4.00,
            'masa_fix' => 3,
            'bunga_floating' => 13.50,
            'is_active' => true,
        ]);

        \App\Models\KprPromo::create([
            'nama' => 'BNI Griya Fixed 5 Tahun',
            'bunga_fix' => 4.50,
            'masa_fix' => 5,
            'bunga_floating' => 13.50,
            'is_active' => true,
        ]);

        \App\Models\KprPromo::create([
            'nama' => 'BNI Griya Fixed 10 Tahun',
            'bunga_fix' => 5.50,
            'masa_fix' => 10,
            'bunga_floating' => 13.50,
            'is_active' => true,
        ]);
    }
}
