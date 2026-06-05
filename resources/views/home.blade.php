@extends('layouts.app')

@section('title', isset($category)
    ? "Jual Properti di {$category->name} – Bintaro Land Property"
    : 'Bintaro Land Property – Agen Properti Terpercaya di Bintaro & Sekitarnya')

@section('meta_description', isset($category)
    ? "Cari dan temukan rumah, ruko, atau kavling terbaik di {$category->name} bersama Bintaro Land Property. Dapatkan penawaran properti eksklusif hari ini."
    : 'Bintaro Land Property adalah agen properti terpercaya di Bintaro, Tangerang Selatan. Temukan rumah impian, kavling strategis, dan investasi properti terbaik.')

@section('content')

@php
    $requestCategory = request('category');
    $categoryName = null;
    $categorySlug = null;
    
    $groups = [
        'primary' => 'Primary Bintaro Jaya',
        'secondary' => 'Secondary Bintaro Jaya',
        'luar_bintaro' => 'Diluar Bintaro'
    ];

    if (isset($category)) {
        $categoryName = $category->name;
        $categorySlug = $category->slug;
    } elseif (is_string($requestCategory) && isset($groups[$requestCategory])) {
        $categorySlug = $requestCategory;
        $categoryName = $groups[$requestCategory];
    } elseif (is_object($requestCategory)) {
        $categoryName = $requestCategory->name;
        $categorySlug = $requestCategory->slug;
    } elseif ($requestCategory !== null && $requestCategory !== '') {
        $categorySlug = $requestCategory;
        if (is_numeric($requestCategory)) {
            $foundCat = $categories->firstWhere('id', (int) $requestCategory);
        } else {
            $foundCat = $categories->firstWhere('slug', $requestCategory);
        }
        
        if ($foundCat) {
            $categoryName = $foundCat->name;
        }
    }
    $hasCategory = !empty($categorySlug);
@endphp

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- HERO                                          --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section class="relative pt-16 lg:pt-[68px] overflow-hidden min-h-[72vh] flex items-end">

    {{-- Background image --}}
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1800&q=80"
             alt="Properti Bintaro"
             class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/90 via-charcoal-950/65 to-charcoal-950/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/80 via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 container-main pb-12 pt-20 lg:pb-16 lg:pt-24 w-full">
        <div class="max-w-2xl">

            {{-- Category badge or tag line --}}
            <div class="flex items-center gap-2 mb-5">
                <span class="inline-block w-8 h-px bg-brand-400"></span>
                <p class="text-brand-300 text-xs font-semibold tracking-[0.18em] uppercase">
                    @if(isset($category))
                        Kategori: {{ $category->name }}
                    @else
                        Agen Properti Terpercaya · Bintaro & Sekitarnya
                    @endif
                </p>
            </div>

            {{-- Headline --}}
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.15] mb-5" data-aos="fade-up">
                @if(isset($category))
                    Properti <span class="text-brand-400">{{ $category->name }}</span><br>
                    Pilihan Terbaik
                @else
                    Hunian Premium di Bintaro<br>
                    <span class="text-brand-400">untuk Keluarga Modern</span>
                @endif
            </h1>

            <p class="text-gray-300 text-base leading-relaxed mb-6 max-w-xl" data-aos="fade-up" data-aos-delay="100">
                @if(isset($category))
                    Temukan pilihan properti terbaik kategori {{ $category->name }} yang sesuai kebutuhan dan anggaran Anda.
                @else
                    Kami membantu Anda menemukan rumah, kavling, dan properti investasi yang tepat — dengan pelayanan profesional dan jujur.
                @endif
            </p>

            <div class="mb-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('about') }}" class="inline-block px-8 py-3 border border-white/30 hover:border-white/60 text-white text-base font-medium rounded-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-white/10">
                    Tentang Kami
                </a>
            </div>

            {{-- Quick stats row --}}
            @if(!isset($category))
            <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-sm text-gray-300" data-aos="fade-up" data-aos-delay="300">
                <div>
                    <span class="text-white font-bold text-xl">1.200+</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Properti Tersedia</span>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div>
                    <span class="text-white font-bold text-xl">5+</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Tahun Pengalaman</span>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div>
                    <span class="text-white font-bold text-xl">500+</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Keluarga Puas</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- SEARCH / FILTER BAR (Collapsible Dropdown)   --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section id="search-section"
         class="bg-white dark:bg-charcoal-950 border-b border-gray-200 dark:border-charcoal-800 sticky top-16 lg:top-[68px] z-30">
    <div class="container-main">

        {{-- ── Collapsed trigger row (always visible) ── --}}
        <button type="button" id="search-toggle"
                class="flex items-center gap-2.5 w-full py-2.5 text-left group">
            <svg class="w-4 h-4 text-gray-400 group-hover:text-brand-500 transition-colors flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span id="search-summary" class="flex-1 text-sm text-gray-400 dark:text-charcoal-400 truncate">
                @if(request('search') || $hasCategory)
                    Filter aktif: {{ implode(', ', array_filter([
                        request('search'),
                        $categoryName ?: $categorySlug
                    ])) }}
                @else
                    Cari nama, lokasi, atau tipe properti…
                @endif
            </span>
            <span class="text-xs text-brand-600 dark:text-brand-400 font-medium flex-shrink-0 flex items-center gap-1">
                Filter
                <svg id="search-chevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>

        <div id="search-panel"
             class="transition-all duration-300 ease-in-out"
             style="max-height: 0; overflow: hidden;">
            <form action="{{ route('search') }}" method="POST" id="search-form" class="relative">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2 pb-3 pt-1">

                    {{-- Keyword --}}
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search"
                               id="search-input"
                               value="{{ request('search') }}"
                               placeholder="Cari nama, lokasi…"
                               class="field pl-9 w-full text-sm">
                    </div>

                    {{-- Category --}}
                    <div class="sm:w-56 relative">
                        <input type="hidden" name="category" id="category-input" value="{{ $categorySlug }}">
                        <button type="button" id="mega-menu-btn" class="field-select w-full text-sm text-left flex justify-between items-center cursor-pointer hover:border-brand-300 dark:hover:border-brand-400 transition-colors">
                            <span id="mega-menu-label" class="truncate font-medium text-gray-700 dark:text-gray-200">{{ $categoryName ?: 'Semua Lokasi / Tipe' }}</span>
                            <svg class="w-4 h-4 ml-2 flex-shrink-0 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>

                    {{-- Sort --}}
                    <div class="sm:w-40">
                        <select name="sort" class="field-select w-full text-sm">
                            <option value="latest"     {{ request('sort','latest') === 'latest'     ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low"  {{ request('sort') === 'price_low'  ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary px-5 shrink-0 text-sm">Cari</button>
                </div>

                {{-- Mega Menu Dropdown Panel --}}
                <div id="mega-menu-panel" class="hidden absolute top-[calc(100%-8px)] left-0 right-0 bg-white dark:bg-charcoal-900 border border-gray-200 dark:border-charcoal-800 shadow-2xl rounded-xl p-6 z-[60]" style="max-height: 60vh; overflow-y: auto; overscroll-behavior: contain;">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($parentCategories as $parent)
                            <div>
                                <h3 class="text-brand-800 dark:text-brand-400 font-bold text-sm uppercase tracking-wider border-b border-gray-100 dark:border-charcoal-800 pb-2 mb-3 cursor-pointer hover:text-brand-600 dark:hover:text-brand-300 transition-colors" 
                                    onclick="selectCategory('{{ $parent->group_type }}', 'Semua {{ $parent->name }}')">
                                    {{ $parent->name }}
                                </h3>
                                <ul class="space-y-1.5 text-sm">
                                    @foreach($parent->children as $child)
                                        <li>
                                            <a href="#" onclick="selectCategory('{{ $child->id }}', '{{ $child->name }}'); return false;" 
                                               class="text-gray-600 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-charcoal-800 px-2 py-1.5 -mx-2 rounded-md flex items-center gap-2 transition-colors">
                                                <span class="w-1 h-1 rounded-full bg-gray-400 dark:bg-gray-600"></span>
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-100 dark:border-charcoal-800 mt-5 pt-4 flex justify-between items-center">
                        <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">Pilih "Semua Lokasi" untuk mencari di seluruh area Bintaro.</span>
                        <a href="#" onclick="selectCategory('', 'Semua Lokasi / Tipe'); return false;" class="text-brand-600 dark:text-brand-400 hover:underline text-sm font-semibold">Clear / Semua Lokasi</a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    {{-- Search toggle script --}}
    <script>
    (function() {
        const toggle  = document.getElementById('search-toggle');
        const panel   = document.getElementById('search-panel');
        const chevron = document.getElementById('search-chevron');
        const input   = document.getElementById('search-input');
        
        // Mega Menu elements
        const megaMenuBtn = document.getElementById('mega-menu-btn');
        const megaMenuPanel = document.getElementById('mega-menu-panel');
        const categoryInput = document.getElementById('category-input');
        const megaMenuLabel = document.getElementById('mega-menu-label');

        let open = false;

        window.selectCategory = function(slug, name) {
            if (categoryInput) categoryInput.value = slug;
            if (megaMenuLabel) megaMenuLabel.innerText = name;
            if (megaMenuPanel) megaMenuPanel.classList.add('hidden');
        };

        if (megaMenuBtn && megaMenuPanel) {
            megaMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                megaMenuPanel.classList.toggle('hidden');
            });
            
            // Prevent closing when clicking inside panel
            megaMenuPanel.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        function openPanel() {
            open = true;
            panel.style.maxHeight = panel.scrollHeight + 500 + 'px'; // +500 to account for mega menu overflow potentially
            chevron.style.transform = 'rotate(180deg)';
            setTimeout(() => {
                panel.style.overflow = 'visible';
                if(input) input.focus();
            }, 300);
        }

        function closePanel() {
            open = false;
            panel.style.overflow = 'hidden';
            panel.style.maxHeight = '0';
            chevron.style.transform = '';
            if (megaMenuPanel) megaMenuPanel.classList.add('hidden');
        }

        toggle.addEventListener('click', () => open ? closePanel() : openPanel());

        // Close when clicking outside
        document.addEventListener('click', e => {
            if (open && !document.getElementById('search-section').contains(e.target)) {
                closePanel();
            } else if (open && megaMenuPanel && !megaMenuPanel.classList.contains('hidden') && !megaMenuBtn.contains(e.target) && !megaMenuPanel.contains(e.target)) {
                // If only clicking outside mega menu but inside search section
                megaMenuPanel.classList.add('hidden');
            }
        });

        // If filter is active, auto-open on page load
        @if(request('search') || $hasCategory || request('sort') && request('sort') !== 'latest')
        openPanel();
        @endif
    })();
    </script>
</section>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- FEATURED PROPERTIES (only on homepage)        --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
@if(!isset($category) && !$hasCategory && !request('search') && !request('min_price') && !request('max_price') && $featuredProperties->count() > 0)
<section class="py-12 lg:py-16 bg-gray-50 dark:bg-charcoal-900/50">
    <div class="container-main">
        <div class="flex items-end justify-between mb-7">
            <div>
                <div class="flex items-center gap-1.5 mb-2">
                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="section-label !mb-0 text-red-500">Pilihan Editor</p>
                </div>
                <h2 class="text-3xl lg:text-4xl font-serif font-extrabold text-gray-900 dark:text-white">
                    Properti <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-amber-500">Hotsale</span>
                </h2>
            </div>
            <a href="{{ route('home') }}#properties" class="text-sm text-brand-600 dark:text-brand-400 hover:underline font-medium hidden sm:block">
                Lihat semua →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featuredProperties as $property)
                @include('components.property-card', ['property' => $property])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- ALL PROPERTIES                                --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section id="properties" class="py-12 lg:py-16 bg-white dark:bg-charcoal-950">
    <div class="container-main">

        <div class="flex items-end justify-between mb-7">
            <div>
                @if(isset($category))
                    <p class="section-label mb-2">{{ $category->name }}</p>
                    <h2 class="text-3xl lg:text-4xl font-serif font-extrabold text-gray-900 dark:text-white relative inline-block">
                        Properti {{ $category->name }}
                        <span class="absolute -bottom-2 left-0 w-1/3 h-1.5 bg-brand-500 rounded-full"></span>
                    </h2>
                @else
                    <p class="section-label mb-2">Semua Listing</p>
                    <h2 class="text-3xl lg:text-4xl font-serif font-extrabold text-gray-900 dark:text-white relative inline-block">
                        Daftar Properti
                        <span class="absolute -bottom-2 left-0 w-1/3 h-1.5 bg-brand-500 rounded-full"></span>
                    </h2>
                @endif
            </div>
            <div class="flex items-center gap-3">
                @if(isset($category))
                    <a href="{{ route('home') }}" class="btn-outline text-xs px-3 py-1.5">
                        ← Semua
                    </a>
                @endif
                <p class="text-sm text-gray-400 dark:text-charcoal-500 hidden sm:block">
                    {{ $properties->total() }} properti ditemukan
                </p>
            </div>
        </div>

        {{-- Active filters --}}
        @if(request('search') || $hasCategory)
            <div class="flex flex-wrap gap-2 mb-5">
                <span class="text-xs text-gray-400 self-center">Filter:</span>
                @if(request('search'))
                    <span class="flex items-center gap-1 px-2.5 py-1 bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 text-xs rounded-full border border-brand-200 dark:border-brand-800">
                        "{{ request('search') }}"
                        <a href="{{ route('home', array_filter(request()->except('search'))) }}" class="hover:text-brand-900 ml-0.5">×</a>
                    </span>
                @endif
                @if($categoryName)
                    <span class="flex items-center gap-1 px-2.5 py-1 bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 text-xs rounded-full border border-brand-200 dark:border-brand-800">
                        {{ $categoryName }}
                        <a href="{{ route('home', array_filter(request()->except('category'))) }}" class="hover:text-brand-900 ml-0.5">×</a>
                    </span>
                @endif
            </div>
        @endif

        {{-- Grid --}}
        @if($properties->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($properties as $property)
                    @include('components.property-card', ['property' => $property])
                @endforeach
            </div>
            <div class="mt-10">
                {{ $properties->links('components.pagination') }}
            </div>
        @else
            <div class="text-center py-16 border border-dashed border-gray-200 dark:border-charcoal-700 rounded-lg">
                <svg class="w-10 h-10 text-gray-300 dark:text-charcoal-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
                <p class="text-gray-500 dark:text-charcoal-400 text-sm mb-4">Tidak ada properti yang sesuai filter.</p>
                <a href="{{ route('home') }}" class="btn-primary text-sm">Reset Filter</a>
            </div>
        @endif
    </div>
</section>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- AREA FAVORIT, MENGAPA KAMI & KONTAK (only on homepage) --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
@if(!isset($category) && !$hasCategory && !request('search') && !request('min_price') && !request('max_price'))
{{-- 
<section class="py-12 lg:py-16 bg-gray-50 dark:bg-charcoal-900/50 border-t border-gray-200 dark:border-charcoal-800">
    <div class="container-main">
        <div class="mb-8">
            <p class="section-label mb-1">Lokasi Populer</p>
            <h2 class="text-2xl lg:text-3xl font-serif font-bold text-gray-900 dark:text-white">Area Favorit</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $areas = [
                    ['name' => 'Area Favorit Primary Bintaro', 'slug' => 'rumah-primary-bintaro-jaya', 'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&q=80'],
                    ['name' => 'Area Favorit Bintaro', 'slug' => 'rumah-bintaro', 'img' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=600&q=80'],
                    ['name' => 'Area Favorit Luar Bintaro', 'slug' => 'rumah-diluar-bintaro', 'img' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=600&q=80'],
                ];
            @endphp
            @foreach($areas as $area)
                <a href="{{ route('area.show', $area['slug']) }}"
                   class="group relative overflow-hidden rounded-xl aspect-[16/10] sm:aspect-[4/3] md:aspect-[3/4] block shadow-md hover:shadow-lg transition-all duration-300">
                    <img src="{{ $area['img'] }}" alt="{{ $area['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/35 to-black/10"></div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <p class="text-lg font-serif font-bold leading-tight group-hover:text-brand-300 transition-colors">
                            {{ $area['name'] }}
                        </p>
                        <span class="inline-flex items-center gap-1 text-xs text-gray-300 mt-2 font-medium">
                            Lihat Properti
                            <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
--}}

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- MENGAPA KAMI                                  --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section class="py-12 lg:py-16 bg-white dark:bg-charcoal-950 border-t border-gray-200 dark:border-charcoal-800">
    <div class="container-main">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            {{-- Left text --}}
            <div data-aos="fade-right">
                <p class="section-label mb-2">Keunggulan Kami</p>
                <h2 class="text-2xl lg:text-3xl font-serif font-bold text-gray-900 dark:text-white mb-4 leading-snug">
                    Mengapa Memilih<br>Bintaro Land Property?
                </h2>
                <p class="text-gray-500 dark:text-charcoal-400 text-sm leading-relaxed mb-8">
                    Kami bukan sekadar agen properti. Kami mitra yang memahami kebutuhan keluarga Indonesia — dari pencarian hingga serah terima kunci.
                </p>

                <ul class="space-y-5">
                    @php
                        $reasons = [
                            ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Legalitas Terjamin', 'desc' => 'Setiap properti yang kami tawarkan telah melalui verifikasi dokumen secara menyeluruh.'],
                            ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Tim Berpengalaman', 'desc' => 'Agen kami memiliki pengalaman lebih dari 5 tahun di pasar properti Bintaro dan sekitarnya.'],
                            ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'title' => 'Konsultasi Gratis via WA', 'desc' => 'Hubungi kami kapan saja lewat WhatsApp, tanpa biaya konsultasi. Tim kami siap 7 hari seminggu.'],
                            ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Harga Transparan', 'desc' => 'Tidak ada biaya tersembunyi. Kami terbuka mengenai semua biaya sejak awal.'],
                        ];
                    @endphp
                    @foreach($reasons as $i => $r)
                        <li class="flex gap-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="flex-shrink-0 w-9 h-9 rounded-md bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center mt-0.5">
                                <svg class="w-4.5 h-4.5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $r['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">{{ $r['title'] }}</p>
                                <p class="text-sm text-gray-500 dark:text-charcoal-400 leading-relaxed">{{ $r['desc'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Right image collage --}}
            <div class="grid grid-cols-2 gap-3" data-aos="fade-left">
                <div class="rounded-lg overflow-hidden aspect-[3/4]">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=500&q=80" alt="Interior" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-3">
                    <div class="rounded-lg overflow-hidden aspect-video">
                        <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=400&q=80" alt="Ruang tamu" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-lg overflow-hidden flex-1">
                        <img src="https://images.unsplash.com/photo-1560184897-ae75f418493e?w=400&q=80" alt="Eksterior" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- WHATSAPP CTA SECTION                          --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section id="kontak" class="relative py-16 lg:py-20 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1600&q=70" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-charcoal-950 bg-opacity-75"></div>
    </div>
    <div class="relative z-10 container-main text-center">
        <p class="section-label text-brand-400 mb-3" data-aos="fade-up">Mulai Hari Ini</p>
        <h2 class="font-serif text-3xl lg:text-4xl font-bold text-white mb-4 max-w-xl mx-auto leading-snug" data-aos="fade-up" data-aos-delay="100">
            Siap Temukan Properti Ideal Anda?
        </h2>
        <p class="text-gray-400 text-sm max-w-md mx-auto mb-8 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
            Konsultasi langsung dengan agen kami via WhatsApp.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3" data-aos="fade-up" data-aos-delay="300">
            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}?text={{ urlencode('Halo Bintaro Land Property, saya ingin konsultasi properti.') }}"
               target="_blank" rel="noopener noreferrer"
               class="btn-wa px-8 py-3 text-base">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
            <a href="{{ route('home') }}#properties" class="px-8 py-3 border border-white/30 hover:border-white/60 text-white text-base font-medium rounded-md transition-colors duration-150">
                Lihat Properti →
            </a>
        </div>
    </div>
</section>
@endif
@if(isset($activePromo) && $activePromo && !isset($category) && !$hasCategory && !request('search') && !request('min_price') && !request('max_price'))
    <x-promo-modal :promo="$activePromo" />
@endif

@endsection
