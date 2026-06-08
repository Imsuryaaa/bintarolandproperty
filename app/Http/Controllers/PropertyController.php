<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display the homepage with property listings and filters.
     */
    public function index(Request $request): View
    {
        $query = Property::query()
            ->with(['categories', 'photos']);

        // Apply category filter (can be group_type or specific category slug/id)
        if ($request->filled('category')) {
            $catInput = $request->input('category');
            
            // Check if it's a group_type
            if (in_array($catInput, ['primary', 'secondary', 'luar_bintaro'])) {
                $query->whereHas('categories', function($q) use ($catInput) {
                    $q->where('group_type', $catInput);
                });
            } else {
                // Otherwise it's a specific category (slug or id)
                $query->whereHas('categories', function($q) use ($catInput) {
                    if (is_numeric($catInput)) {
                        $q->where('categories.id', $catInput);
                    } else {
                        $q->where('categories.slug', $catInput);
                    }
                });
            }
        }

        // Apply condition filter (kept for backward compatibility but removed from frontend)
        if ($request->filled('condition')) {
            $query->byCondition($request->input('condition'));
        }

        // Apply search keyword
        if ($request->filled('search')) {
            $query->search($request->input('search'));
        }

        // Apply price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Apply sorting
        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'latest' => $query->latest(),
            default => $query->latest(),
        };

        $properties = $query->paginate(6)->withQueryString();

        // Get filter options
        $categories = Category::orderBy('name')->get();
        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
        $conditions = \App\Models\Property::CONDITIONS;

        // Get featured properties for hero section
        $featuredProperties = Property::featured()
            ->latest()
            ->with(['categories', 'photos'])
            ->take(9)
            ->get();

        $areaStructures = $this->getAreaStructures();
        $activePromo = \App\Models\Promo::activeScheduled()->first();

        return view('home', compact(
            'properties',
            'categories',
            'parentCategories',
            'conditions',
            'featuredProperties',
            'areaStructures',
            'activePromo'
        ));
    }

    /**
     * Display all properties page (newest to oldest, paginated, with search & filter).
     */
    public function allProperties(Request $request): View
    {
        $query = Property::query()->with(['categories', 'photos']);

        // Keyword search
        if ($request->filled('search')) {
            $query->search($request->input('search'));
        }

        // Category filter
        if ($request->filled('category')) {
            $catInput = $request->input('category');
            if (in_array($catInput, ['primary', 'secondary', 'luar_bintaro'])) {
                $query->whereHas('categories', fn($q) => $q->where('group_type', $catInput));
            } else {
                $query->whereHas('categories', function ($q) use ($catInput) {
                    is_numeric($catInput)
                        ? $q->where('categories.id', $catInput)
                        : $q->where('categories.slug', $catInput);
                });
            }
        }

        // Sort
        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_low'  => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            default      => $query->latest(),
        };

        $properties       = $query->paginate(12)->withQueryString();
        $categories       = Category::orderBy('name')->get();
        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
        $totalCount       = Property::count();
        $isHotsale        = false;

        return view('properties.index', compact(
            'properties',
            'categories',
            'parentCategories',
            'totalCount',
            'sort',
            'isHotsale'
        ));
    }

    /**
     * Display hotsale properties page (featured only).
     */
    public function hotsaleProperties(Request $request): View
    {
        $query = Property::query()->where('is_featured', true)->with(['categories', 'photos']);

        // Keyword search
        if ($request->filled('search')) {
            $query->search($request->input('search'));
        }

        // Category filter
        if ($request->filled('category')) {
            $catInput = $request->input('category');
            if (in_array($catInput, ['primary', 'secondary', 'luar_bintaro'])) {
                $query->whereHas('categories', fn($q) => $q->where('group_type', $catInput));
            } else {
                $query->whereHas('categories', function ($q) use ($catInput) {
                    is_numeric($catInput)
                        ? $q->where('categories.id', $catInput)
                        : $q->where('categories.slug', $catInput);
                });
            }
        }

        // Sort
        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_low'  => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            default      => $query->latest(),
        };

        $properties       = $query->paginate(12)->withQueryString();
        $categories       = Category::orderBy('name')->get();
        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
        $totalCount       = Property::where('is_featured', true)->count();
        $isHotsale        = true;

        return view('properties.index', compact(
            'properties',
            'categories',
            'parentCategories',
            'totalCount',
            'sort',
            'isHotsale'
        ));
    }

    /**
     * Display a single property detail.
     * Uses Route Model Binding with eager loading.
     */
    public function show(Property $property): View
    {
        $property->load(['categories', 'conditions', 'photos']);

        // Get related properties from same category
        $relatedProperties = Property::where('id', '!=', $property->id)
            ->whereHas('categories', function ($query) use ($property) {
                $categoryIds = $property->categories->pluck('id');
                $query->whereIn('categories.id', $categoryIds);
            })
            ->with(['categories', 'conditions', 'photos'])
            ->take(4)
            ->get();

        return view('property.show', compact('property', 'relatedProperties'));
    }

    /**
     * Filter properties by category.
     */
    public function byCategory(Request $request, Category $category): View
    {
        $properties = Property::byCategory($category->slug)
            ->with(['categories', 'conditions', 'photos'])
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
        $conditions = \App\Models\Property::CONDITIONS;
        $featuredProperties = collect();
        $areaStructures = $this->getAreaStructures();

        return view('home', compact(
            'properties',
            'categories',
            'parentCategories',
            'conditions',
            'featuredProperties',
            'category',
            'areaStructures'
        ));
    }

    private function getAreaStructures(): array
    {
        return [
            'rumah-primary-bintaro-jaya' => [
                'title' => 'Rumah Primary Bintaro Jaya (Developer)',
                'description' => 'Pilihan rumah baru dan eksklusif langsung dari Developer Bintaro Jaya.',
                'image' => asset('unsplash_image/HalamanArea/HerobannerRumahPrimaryBintaroJaya.jpg'),
                'districts' => [
                    'Kebayoran' => [
                        ['name' => 'Dharmawangsa', 'slug' => 'dharmawangsa-home'],
                        ['name' => 'Nivara', 'slug' => 'nivara-dharmawangsa'],
                        ['name' => 'Naraya', 'slug' => 'naraya-dharmawangsa'],
                    ],
                    'Discovery' => [
                        ['name' => 'Altezza', 'slug' => 'discovery-altezza'],
                        ['name' => 'Azzura', 'slug' => 'discovery-azzura'],
                        ['name' => 'Aluvia', 'slugs' => ['maika-discovery-aluvia', 'vista-discovery-aluvia']],
                        ['name' => 'Riviera', 'slugs' => ['aira-discovery-riviera', 'bria-discovery-riviera']],
                    ],
                    'Botanica' => [
                        ['name' => 'Arallia', 'slug' => 'botanica-arallia'],
                        ['name' => 'Bellisa', 'slug' => 'botanica-bellisa'],
                    ]
                ]
            ],
            'rumah-bintaro' => [
                'title' => 'Rumah Bintaro Secondary',
                'description' => 'Pilihan properti secondary terbaik di kawasan Bintaro.',
                'image' => asset('unsplash_image/HalamanArea/HerobannerRumahBintaroSecondary.jpg'),
                'districts' => [
                    'Area Favorit' => [
                        ['name' => 'Menteng Bintaro', 'slug' => 'menteng'],
                        ['name' => 'Kebayoran', 'slug' => 'kebayoran-residence'],
                        ['name' => 'Emerald', 'slug' => 'emerald'],
                        ['name' => 'Sektor 9', 'slug' => 'sektor-9'],
                    ]
                ]
            ],
            'rumah-diluar-bintaro' => [
                'title' => 'Rumah di Luar Bintaro',
                'description' => 'Pilihan properti strategis di luar kawasan Bintaro Jaya.',
                'image' => asset('unsplash_image/HalamanArea/HerobannerRumahLuarBintaroJaya.jpg'),
                'districts' => [
                    'Wilayah Populer' => [
                        ['name' => 'Pondok Aren (Sekitar Graha Raya & Parigi)', 'slug' => 'pondok-aren'],
                        ['name' => 'Pesanggrahan & Rempoa (Jakarta Selatan)', 'slug' => 'jakarta-selatan'],
                        ['name' => 'Ciputat & Pamulang', 'slug' => 'ciputat-pamulang'],
                    ]
                ]
            ]
        ];
    }

    private function getAreaSlugs(string $area): array
    {
        $structures = $this->getAreaStructures();
        if (!isset($structures[$area])) return [];

        $slugs = [];
        foreach ($structures[$area]['districts'] as $clusters) {
            foreach ($clusters as $cluster) {
                if (isset($cluster['slugs'])) {
                    $slugs = array_merge($slugs, $cluster['slugs']);
                } elseif (isset($cluster['slug'])) {
                    $slugs[] = $cluster['slug'];
                }
            }
        }
        return $slugs;
    }

    /**
     * Display grouped properties for specific areas.
     */
    public function area($area): View
    {
        $structures = $this->getAreaStructures();

        if (!isset($structures[$area])) {
            abort(404);
        }

        $areaData = $structures[$area];
        $groupedProperties = [];

        foreach ($areaData['districts'] as $districtName => $clusters) {
            foreach ($clusters as $cluster) {
                $slugs = $cluster['slugs'] ?? [$cluster['slug']];
                
                $properties = Property::whereHas('categories', function ($q) use ($slugs) {
                    $q->whereIn('slug', $slugs);
                })->with(['categories', 'conditions', 'photos'])
                  ->latest()
                  ->take(6)
                  ->get();

                if ($properties->count() > 0) {
                    $groupedProperties[$districtName][] = [
                        'cluster' => $cluster,
                        'properties' => $properties,
                        // Provide the first slug as a primary link
                        'main_slug' => $slugs[0]
                    ];
                }
            }
        }

        return view('area', compact('areaData', 'groupedProperties'));
    }
}
