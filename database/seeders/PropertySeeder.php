<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    private array $properties = [
        [
            'title' => 'Rumah Mewah Cluster Discovery Azura Bintaro Jaya',
            'price' => 3500000000,
            'description' => 'Rumah mewah dengan desain modern kontemporer di Cluster Discovery Azura Bintaro Jaya. Lingkungan elite dengan security 24 jam, club house, dan taman kota.

**Spesifikasi:**
- 4 Kamar Tidur + 1 Kamar ART
- 3 Kamar Mandi
- Carport 2 mobil + garasi 1 mobil
- Taman depan dan belakang
- Rooftop area

**Fasilitas Umum:**
- Security 24 jam dengan CCTV
- Club house dengan swimming pool
- Jogging track dan taman bermain
- Akses card untuk penghuni

Lokasi strategis dekat Tol Bintaro, Stasiun KRL, dan Bintaro Plaza.',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'land_area' => 200,
            'build_area' => 180,
            'location' => 'Discovery Azura',
            'is_featured' => true,
            'image_path' => 'property-1.jpg',
            'categories' => ['discovery-azura', 'rumah-primary-bintaro-jaya'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Townhouse Exclusive Discovery Maika Bintaro',
            'price' => 5200000000,
            'description' => 'Townhouse exclusive dengan arsitektur modern minimalis di Discovery Maika Bintaro. Hunian premium dengan private garden dan smart home system.

**Spesifikasi:**
- 5 Kamar Tidur
- 4 Kamar Mandi
- Private garden 50m²
- Carport 2 mobil
- Smart home system installed

**Keunggulan Lokasi:**
- 5 menit ke Stasiun KRL Sudimara
- 10 menit ke Tol Bintaro
- Dekat Binus University
- Dekat RS Permata Bintaro

Cocok untuk keluarga modern yang menginginkan kenyamanan dan kemewahan.',
            'bedrooms' => 5,
            'bathrooms' => 4,
            'land_area' => 240,
            'build_area' => 220,
            'location' => 'Discovery Maika',
            'is_featured' => true,
            'image_path' => 'property-2.jpg',
            'categories' => ['discovery-maika', 'rumah-primary-bintaro-jaya'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Rumah Classic Premium Kebayoran Bintaro',
            'price' => 2800000000,
            'description' => 'Rumah bergaya klasik Eropa dengan sentuhan modern di Kebayoran Bintaro. Halaman luas dengan gazebo dan taman yang terawat.

**Spesifikasi:**
- 4 Kamar Tidur
- 3 Kamar Mandi
- Halaman luas 100m²
- Gazebo dan taman
- Carport 2 mobil

**Fasilitas Sekitar:**
- Dekat Pasar Modern Bintaro
- Dekat sekolah internasional
- Akses tol mudah
- Pusat kuliner terdekat

Rumah siap huni dengan kondisi terawat dan lingkungan tenang.',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'land_area' => 300,
            'build_area' => 200,
            'location' => 'Kebayoran',
            'is_featured' => false,
            'image_path' => 'property-3.jpg',
            'categories' => ['kebayoran', 'rumah-bintaro'],
            'conditions' => ['second'],
        ],
        [
            'title' => 'Villa Private Pool Pondok Aren & Parigi',
            'price' => 7500000000,
            'description' => 'Villa mewah dengan private pool dan taman tropis di Pondok Aren. Hunian eksklusif dengan privasi tinggi dan fasilitas resort-style.

**Spesifikasi:**
- 6 Kamar Tidur
- 5 Kamar Mandi
- Private swimming pool 8x4m
- Taman tropis 200m²
- Guest house terpisah
- Carport 3 mobil

**Fasilitas:**
- Private pool dengan jacuzzi
- Rooftop lounge
- Home theater room
- Wine cellar

Hunian impian untuk gaya hidup luxury dengan privasi maksimal.',
            'bedrooms' => 6,
            'bathrooms' => 5,
            'land_area' => 500,
            'build_area' => 450,
            'location' => 'Pondok Aren',
            'is_featured' => true,
            'image_path' => 'property-4.jpg',
            'categories' => ['pondok-aren-parigi', 'rumah-diluar-bintaro'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Rumah Modern Minimalis Ciputat & Pamulang',
            'price' => 1850000000,
            'description' => 'Rumah modern minimalis dengan desain fungsional di Pamulang. Cocok untuk pasangan muda atau keluarga kecil.

**Spesifikasi:**
- 3 Kamar Tidur
- 2 Kamar Mandi
- Ruang kerja/home office
- Taman belakang
- Carport 1 mobil

**Keunggulan:**
- Harga terjangkau untuk lokasi strategis
- Dekat Universitas Pamulang
- Dekat RS Sari Asih
- Akses transportasi umum mudah

Rumah baru siap huni dengan desain modern dan efisien.',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'land_area' => 120,
            'build_area' => 100,
            'location' => 'Pamulang',
            'is_featured' => false,
            'image_path' => 'property-5.jpg',
            'categories' => ['ciputat-pamulang', 'rumah-diluar-bintaro'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Kavling Premium Emerald Bintaro Jaya',
            'price' => 4200000000,
            'description' => 'Kavling premium di lokasi terbaik Emerald Bintaro Jaya. Siap bangun dengan izin mendirikan bangunan (IMB) yang sudah tersedia.

**Spesifikasi Tanah:**
- Luas tanah 400 m²
- Akses jalan utama cluster
- Hook/corner lot
- Pagar sudah terpasang
- Listrik dan air PAM tersedia

**Keunggulan Lokasi:**
- Posisi strategis di pusat Bintaro
- Dekat Bintaro Jaya Xchange Mall
- Dekat sekolah favorit
- Akses tol 5 menit

Kesempatan langka memiliki kavling premium di lokasi prime Bintaro.',
            'bedrooms' => 0,
            'bathrooms' => 0,
            'land_area' => 400,
            'build_area' => 0,
            'location' => 'Emerald',
            'is_featured' => false,
            'image_path' => 'property-6.jpg',
            'categories' => ['emerald', 'rumah-bintaro'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Rumah Scandinavian Discovery Navia Bintaro',
            'price' => 2600000000,
            'description' => 'Rumah bergaya Scandinavian dengan nuansa hangat dan cozy di Discovery Navia Bintaro. Desain interior terbaik dengan pencahayaan alami optimal.

**Spesifikasi:**
- 3 Kamar Tidur + 1 Kamar multifungsi
- 2 Kamar Mandi
- Open plan living room
- Dapur modern
- Carport 1 mobil + area tamu

**Desain Interior:**
- Lantai kayu engineered
- Custom kitchen set
- Smart lighting system
- Full AC di semua ruangan

Rumah dengan konsep Nordic yang nyaman dan estetik.',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'land_area' => 150,
            'build_area' => 130,
            'location' => 'Discovery Navia',
            'is_featured' => true,
            'image_path' => 'property-7.jpg',
            'categories' => ['discovery-navia', 'rumah-primary-bintaro-jaya'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Hunian Minimalis Discovery Vista Bintaro',
            'price' => 495000000,
            'description' => 'Hunian minimalis type premium di Discovery Vista Bintaro. Lingkungan aman dan nyaman, cocok untuk hunian keluarga baru.

**Spesifikasi:**
- 2 Kamar Tidur
- 1 Kamar Mandi
- Ruang tamu
- Dapur
- Carport motor

**Fasilitas Komplek:**
- Taman bermain anak
- Mushola
- Mini market
- Security 24 jam

Kesempatan memiliki rumah di lokasi strategis dengan angsuran ringan.',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'land_area' => 72,
            'build_area' => 45,
            'location' => 'Discovery Vista',
            'is_featured' => false,
            'image_path' => 'property-8.jpg',
            'categories' => ['discovery-vista', 'rumah-primary-bintaro-jaya'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Estate Mewah Menteng Bintaro Sektor 7',
            'price' => 8500000000,
            'description' => 'Estate mewah 2 lantai dengan rooftop garden spektakuler di Menteng Bintaro Sektor 7. Arsitektur kontemporer dengan material premium.

**Spesifikasi:**
- 5 Kamar Tidur + 2 Kamar ART
- 5 Kamar Mandi + 1 Powder room
- Rooftop garden 100m²
- Private elevator
- Wine cellar
- Home gym

**Material Premium:**
- Marmer Italia di lantai utama
- Kitchen set dari Jerman
- Sanitair Grohe dan Toto
- Smart home Loxone system

Hunian super premium untuk gaya hidup eksklusif.',
            'bedrooms' => 5,
            'bathrooms' => 5,
            'land_area' => 350,
            'build_area' => 400,
            'location' => 'Menteng Bintaro',
            'is_featured' => true,
            'image_path' => 'property-9.jpg',
            'categories' => ['menteng-bintaro', 'rumah-bintaro'],
            'conditions' => ['baru'],
        ],
        [
            'title' => 'Rumah Family Friendly Bintaro Sektor 9',
            'price' => 3200000000,
            'description' => 'Rumah keluarga nyaman dengan lingkungan family-friendly dekat Binus University di Bintaro Sektor 9. Akses mudah ke berbagai fasilitas pendidikan.

**Spesifikasi:**
- 4 Kamar Tidur
- 3 Kamar Mandi
- Study room untuk anak
- Taman bermain pribadi
- Carport 2 mobil

**Dekat Sekolah:**
- Binus University (5 menit)
- Santa Ursula (10 menit)
- Mentari School (5 menit)
- Global Jaya School (10 menit)

Lingkungan aman dengan banyak ruang terbuka hijau.',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'land_area' => 180,
            'build_area' => 160,
            'location' => 'Bintaro Sektor 9',
            'is_featured' => false,
            'image_path' => 'property-10.jpg',
            'categories' => ['bintaro-sektor-9', 'rumah-bintaro'],
            'conditions' => ['second'],
        ],
        [
            'title' => 'Discovery Altezza Signature Bintaro Jaya',
            'price' => 1500000000,
            'description' => 'Property investasi dengan ROI tinggi di lokasi strategis Discovery Altezza Bintaro Jaya. Cocok untuk disewakan atau dijual kembali dengan nilai tinggi.

**Spesifikasi:**
- 2 Kamar Tidur
- 1 Kamar Mandi
- Ruang multifungsi
- Taman samping
- Carport 1 mobil

**Potensi Investasi:**
- Nilai tanah naik 15-20% per tahun
- Banyak permintaan sewa dari mahasiswa
- Dekat kampus dan perkantoran
- Akses transportasi mudah

Kesempatan investasi properti terbaik di area Bintaro.',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'land_area' => 100,
            'build_area' => 80,
            'location' => 'Discovery Altezza',
            'is_featured' => false,
            'image_path' => 'property-11.jpg',
            'categories' => ['discovery-altezza', 'rumah-primary-bintaro-jaya', 'discovery', 'rumah-bintaro'],
            'conditions' => ['second'],
        ],
        [
            'title' => 'Discovery Riviera Exclusive Mansion Bintaro',
            'price' => 4100000000,
            'description' => 'Rumah corner lot dengan pemandangan langsung ke taman kota di Discovery Riviera Bintaro. Lokasi premium dengan udara segar dan pencahayaan alami terbaik.

**Spesifikasi:**
- 4 Kamar Tidur
- 3 Kamar Mandi
- Halaman samping ekstra lebar
- Balkon view taman
- Carport 2 mobil + garasi

**View dan Lingkungan:**
- Pemandangan taman kota hijau
- Jalan cluster lebar
- Tetangga harmonis
- Akses 24 jam tanpa gerbang

Lokasi istimewa dengan view yang tidak akan terhalang.',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'land_area' => 250,
            'build_area' => 200,
            'location' => 'Discovery Riviera',
            'is_featured' => true,
            'image_path' => 'property-12.jpg',
            'categories' => ['discovery-riviera', 'rumah-primary-bintaro-jaya'],
            'conditions' => ['baru'],
        ],
    ];

    public function run(): void
    {
        foreach ($this->properties as $propertyData) {
            $categories = $propertyData['categories'] ?? [];
            $conditions = $propertyData['conditions'] ?? [];
            $imagePath = $propertyData['image_path'] ?? null;
            
            // Map location to district and set defaults for location fields
            $location = $propertyData['location'] ?? 'Bintaro';
            $propertyData['city'] = 'Tangerang Selatan';
            $propertyData['district'] = $location;
            $propertyData['province'] = 'Banten';
            
            if (!empty($conditions)) {
                $propertyData['property_condition'] = $conditions[0];
            }
            
            // Ensure unique property code is generated for each seeded property
            if (empty($propertyData['property_code'])) {
                $propertyData['property_code'] = 'PRP-' . strtoupper(\Illuminate\Support\Str::random(6));
            }
            
            unset($propertyData['categories'], $propertyData['conditions'], $propertyData['location'], $propertyData['image_path']);
            
            $property = Property::firstOrCreate(
                ['slug' => $propertyData['slug'] ?? \Illuminate\Support\Str::slug($propertyData['title'])],
                $propertyData
            );
            
            // Seed a property photo if defined
            if ($imagePath) {
                \App\Models\PropertyPhoto::firstOrCreate([
                    'property_id' => $property->id,
                    'file_path'   => $property->property_code . '/' . $imagePath,
                ], [
                    'sort_order'  => 0,
                ]);
            }
            
            // Attach categories
            $categoryIds = Category::whereIn('slug', $categories)->pluck('id');
            $property->categories()->sync($categoryIds);
            
            // Attach conditions
            $conditionIds = Condition::whereIn('slug', $conditions)->pluck('id');
            $property->conditions()->sync($conditionIds);
        }
    }
}
