<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Parent Categories
        $primaryParent = Category::updateOrCreate(
            ['slug' => Str::slug('Primary Bintaro Jaya')],
            ['name' => 'Primary Bintaro Jaya', 'group_type' => 'primary', 'parent_id' => null]
        );

        $secondaryParent = Category::updateOrCreate(
            ['slug' => Str::slug('Secondary Bintaro Jaya')],
            ['name' => 'Secondary Bintaro Jaya', 'group_type' => 'secondary', 'parent_id' => null]
        );

        $luarBintaroParent = Category::updateOrCreate(
            ['slug' => Str::slug('Secondary Diluar Bintaro Jaya')],
            ['name' => 'Secondary Diluar Bintaro Jaya', 'group_type' => 'luar_bintaro', 'parent_id' => null]
        );

        // 2. Define Dataset from Image
        $primaryData = [
            'Dharmawangsa Home', 'Nivara - Dharmawangsa', 'Naraya - Dharmawangsa',
            'Nordic - Kebayoran Harmony', 'Navia - Kebayoran Piazza', 'Chiara - Kebayoran Village',
            'Discovery Altezza', 'Discovery Azzura', 'Maika - Discovery Aluvia',
            'Vista - Discovery Aluvia', '9 Home', 'Montana', 'Aira - Discovery Riviera',
            'Bria - Discovery Riviera', 'Botanica Arallia', 'Botanica Bellisa',
            'Wichita - Bukit Menteng', 'Ruko Emerald Core', 'Ruko Botanica Avenue 2',
            'Ruko Kebayoran Square', 'Ruko U Town House', 'Kavling'
        ];

        $secondaryData = [
            'Menteng', 'Kebayoran residence', 'Discovery', 'Emerald', 'Botanica',
            'Graha Taman', 'Puri Bintaro', 'Graha Raya', 'Sektor 1 - 2',
            'Sektor 3 - 4', 'Sektor 5 - 6', 'Sektor 8', 'Sektor 9'
        ];

        $luarBintaroData = [
            'Pondok Aren', 'Ciputat & Pamulang', 'Jakarta Selatan', 'Serpong & BSD'
        ];

        // 3. Insert and Update Categories
        foreach ($primaryData as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'group_type' => 'primary',
                    'parent_id' => $primaryParent->id
                ]
            );
        }

        foreach ($secondaryData as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'group_type' => 'secondary',
                    'parent_id' => $secondaryParent->id
                ]
            );
        }

        foreach ($luarBintaroData as $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'group_type' => 'luar_bintaro',
                    'parent_id' => $luarBintaroParent->id
                ]
            );
        }
    }
}
