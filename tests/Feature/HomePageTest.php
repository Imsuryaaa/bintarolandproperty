<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Bintaro Land Property');
        $response->assertSee('Temukan Rumah');
    }

    public function test_homepage_displays_properties(): void
    {
        // Seed required data
        Category::create(['name' => 'Sekitar Bintaro', 'slug' => 'sekitar-bintaro']);
        Condition::create(['name' => 'Baru', 'slug' => 'baru']);
        
        $property = Property::create([
            'title' => 'Rumah Mewah Bintaro',
            'slug' => 'rumah-mewah-bintaro',
            'price' => 2500000000,
            'description' => 'Deskripsi properti',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'land_area' => 200,
            'build_area' => 180,
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Rumah Mewah Bintaro');
    }

    public function test_property_detail_page_loads(): void
    {
        Category::create(['name' => 'Sekitar Bintaro', 'slug' => 'sekitar-bintaro']);
        Condition::create(['name' => 'Baru', 'slug' => 'baru']);
        
        $property = Property::create([
            'title' => 'Rumah Mewah Bintaro',
            'slug' => 'rumah-mewah-bintaro',
            'price' => 2500000000,
            'description' => 'Deskripsi properti',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'land_area' => 200,
            'build_area' => 180,
        ]);

        $response = $this->get(route('property.show', $property));

        $response->assertStatus(200);
        $response->assertSee('Rumah Mewah Bintaro');
        $response->assertSee('Rp 2.500.000.000');
    }

    public function test_category_filter_works(): void
    {
        $category = Category::create(['name' => 'Sekitar Bintaro', 'slug' => 'sekitar-bintaro']);
        Condition::create(['name' => 'Baru', 'slug' => 'baru']);
        
        $property = Property::create([
            'title' => 'Rumah di Bintaro',
            'slug' => 'rumah-di-bintaro',
            'price' => 1500000000,
            'description' => 'Deskripsi',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'land_area' => 150,
            'build_area' => 120,
        ]);
        $property->categories()->attach($category);

        $response = $this->get(route('category.show', $category));

        $response->assertStatus(200);
        $response->assertSee('Rumah di Bintaro');
    }

    public function test_search_filter_works(): void
    {
        Category::create(['name' => 'Sekitar Bintaro', 'slug' => 'sekitar-bintaro']);
        Condition::create(['name' => 'Baru', 'slug' => 'baru']);
        
        Property::create([
            'title' => 'Rumah Mewah Cluster',
            'slug' => 'rumah-mewah-cluster',
            'price' => 3500000000,
            'description' => 'Deskripsi properti mewah',
            'bedrooms' => 5,
            'bathrooms' => 4,
            'land_area' => 300,
            'build_area' => 250,
        ]);

        $response = $this->get(route('home', ['search' => 'mewah cluster']));

        $response->assertStatus(200);
        $response->assertSee('Rumah Mewah Cluster');
    }
}
