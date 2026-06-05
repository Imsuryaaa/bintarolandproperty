<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Support\Str;

class PropertyDummySeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Lakukan truncate pada tabel-tabel terkait
        DB::table('properties')->truncate();
        DB::table('category_property')->truncate();
        DB::table('condition_property')->truncate();
        DB::table('property_photos')->truncate();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create('id_ID');

        // Ambil semua Kategori Anak (yang memiliki parent_id)
        $childCategories = Category::whereNotNull('parent_id')->get();

        foreach ($childCategories as $category) {
            // Buat 5 properti untuk masing-masing kategori anak
            // 2 properti dengan harga rendah, 3 properti dengan harga tinggi
            for ($i = 1; $i <= 5; $i++) {
                
                // Tentukan harga tinggi atau rendah
                if ($i <= 2) {
                    // Harga rendah: 500 Juta - 1,5 Miliar
                    $price = $faker->numberBetween(500000000, 1500000000);
                } else {
                    // Harga tinggi: 3 Miliar - 10 Miliar
                    $price = $faker->numberBetween(3000000000, 10000000000);
                }

                $title = "Rumah " . $faker->randomElement(['Minimalis', 'Mewah', 'Klasik', 'Modern', 'Asri']) . " di " . $category->name;
                
                $property = Property::create([
                    'title' => $title,
                    'slug' => Str::slug($title . '-' . Str::random(5)),
                    'property_code' => "PRP-" . $faker->unique()->randomNumber(5, true),
                    'property_type' => 'rumah',
                    'property_condition' => $faker->randomElement(['baru', 'second']),
                    'price' => $price,
                    'bedrooms' => $faker->numberBetween(2, 6),
                    'bathrooms' => $faker->numberBetween(1, 4),
                    'land_area' => $faker->numberBetween(60, 300),
                    'build_area' => $faker->numberBetween(50, 250),
                    'province' => 'Banten',
                    'city' => 'Tangerang Selatan',
                    'district' => 'Bintaro Jaya',
                    'description' => "Properti premium yang berlokasi strategis di " . $category->name . ". Dilengkapi dengan fasilitas modern, akses mudah ke tol dan stasiun, serta keamanan 24 jam. Sangat cocok untuk hunian keluarga maupun investasi masa depan.",
                ]);

                // Attach relasi ke kategori ini
                $property->categories()->attach($category->id);
            }
        }
    }
}
