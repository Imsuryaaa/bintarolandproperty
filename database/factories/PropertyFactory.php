<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    private array $propertyTitles = [
        'Rumah Mewah Cluster Exclusive Bintaro Jaya',
        'Kavling Premium Lokasi Strategis Bintaro',
        'Rumah Modern Minimalis Dekat Stasiun',
        'Townhouse Luxurious Design Bintaro',
        'Rumah Classic Elegan dengan Taman Luas',
        'Villa Private Pool di Komplek Elite',
        'Rumah Scandinavian Style Bintaro Sektor 9',
        'Smart Home Modern dengan Security 24 Jam',
        'Rumah Corner Lot dengan View Taman',
        'Estate Mewah 2 Lantai plus Rooftop',
        'Rumah Kontemporer di Pusat Bintaro',
        'Property Investasi Terbaik Bintaro',
        'Rumah Subsidi Premium Bintaro Residence',
        'Luxury Living di Kawasan Elite Bintaro',
        'Rumah Family Friendly Dekat Sekolah',
    ];

    private array $locations = [
        'Bintaro Sektor 1',
        'Bintaro Sektor 2',
        'Bintaro Sektor 3',
        'Bintaro Sektor 4',
        'Bintaro Sektor 5',
        'Bintaro Sektor 7',
        'Bintaro Sektor 9',
        'Bintaro Jaya',
        'Pondok Aren',
        'Pondok Jaya',
        'Ciputat',
        'Pamulang',
    ];

    public function definition(): array
    {
        $title = $this->faker->unique()->randomElement($this->propertyTitles);
        $bedrooms = $this->faker->numberBetween(2, 6);
        $bathrooms = $this->faker->numberBetween(1, 4);
        $landArea = $this->faker->numberBetween(90, 500);
        $buildArea = (int) ($landArea * $this->faker->randomFloat(1, 0.4, 0.8));
        
        // Price range: 500 juta to 15 miliar
        $price = $this->faker->randomFloat(2, 500000000, 15000000000);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'price' => $price,
            'description' => $this->generateDescription($title, $bedrooms, $bathrooms, $landArea, $buildArea),
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'land_area' => $landArea,
            'build_area' => $buildArea,
            'image_path' => null, // Will use placeholder
            'location' => $this->faker->randomElement($this->locations),
            'is_featured' => $this->faker->boolean(30),
        ];
    }

    private function generateDescription(string $title, int $bedrooms, int $bathrooms, int $landArea, int $buildArea): string
    {
        $features = [
            'Akses jalan lebar dan bebas banjir',
            'Lingkungan aman dengan security 24 jam',
            'Dekat dengan pusat perbelanjaan dan sekolah',
            'Fasilitas umum lengkap di sekitar',
            'Udara sejuk dan lingkungan asri',
            'Akses mudah ke tol dan transportasi publik',
            'Komunitas yang ramah dan harmonis',
            'Taman bermain dan area jogging track',
            'Cocok untuk keluarga modern',
        ];

        $description = "**{$title}** adalah properti premium yang menawarkan kenyamanan tinggal terbaik di kawasan Bintaro. ";
        $description .= "Dengan desain modern dan lokasi strategis, rumah ini memiliki {$bedrooms} kamar tidur dan {$bathrooms} kamar mandi. ";
        $description .= "Luas tanah {$landArea} m² dan luas bangunan {$buildArea} m² memberikan ruang yang cukup untuk keluarga.\n\n";
        $description .= "**Keunggulan:**\n";
        
        $selectedFeatures = array_rand(array_flip($features), min(4, count($features)));
        if (!is_array($selectedFeatures)) {
            $selectedFeatures = [$selectedFeatures];
        }
        
        foreach ($selectedFeatures as $feature) {
            $description .= "- {$feature}\n";
        }
        
        $description .= "\n**Fasilitas:**\n";
        $description .= "- Carport untuk 2 mobil\n";
        $description .= "- Taman belakang\n";
        $description .= "- Listrik 2200W\n";
        $description .= "- Air bersih (PAM)\n";
        $description .= "- Internet fiber optic ready\n\n";
        $description .= "Jangan lewatkan kesempatan untuk memiliki properti istimewa ini. Hubungi kami segera untuk survey dan informasi lebih lanjut!";

        return $description;
    }
}
