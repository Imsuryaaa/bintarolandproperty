@extends('layouts.app')

@section('title', 'Jual ' . $property->title . ($property->district ? ' di ' . $property->district : ' di Bintaro') . ' | Bintaro Land Property')
@section('meta_description', 'Dijual ' . $property->title . '. ' . Str::limit(strip_tags($property->description), 120))

@php
    use Illuminate\Support\Str;
    $property->load('photos');
    $allPhotos = $property->photos->count()
        ? $property->photos->map(fn($p) => $p->url)->values()->toArray()
        : [$property->image_url];
@endphp

@section('head')
{{-- Open Graph / WhatsApp preview --}}
<meta property="og:type"        content="website">
<meta property="og:url"         content="{{ url()->current() }}">
<meta property="og:title"       content="{{ $property->title }} | Bintaro Land Property">
<meta property="og:description" content="{{ Str::limit(strip_tags($property->description), 155) }}">
<meta property="og:image"       content="{{ $allPhotos[0] ?? asset('images/logo.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name"   content="Bintaro Land Property">
<meta name="twitter:card"       content="summary_large_image">
<meta name="twitter:image"      content="{{ $allPhotos[0] ?? asset('images/logo.jpg') }}">

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $property->title }}",
  "image": [
    "{{ $allPhotos[0] ?? '' }}"
  ],
  "description": "{{ Str::limit(strip_tags($property->description), 150) }}",
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $property->price }}",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endsection

@section('content')

{{-- Page offset for fixed navbar --}}
<div class="pt-16 lg:pt-[68px]">

    {{-- ── Breadcrumb ─────────────────────────────── --}}
    <div class="bg-gray-50 dark:bg-charcoal-900 border-b border-gray-200 dark:border-charcoal-800">
        <div class="container-main py-3">
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-charcoal-400">
                    <li><a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Beranda</a></li>
                    <li class="text-gray-300 dark:text-charcoal-600">/</li>
                    <li><a href="{{ route('home') }}#properties" class="hover:text-brand-600 transition-colors">Properti</a></li>
                    <li class="text-gray-300 dark:text-charcoal-600">/</li>
                    <li class="text-gray-700 dark:text-charcoal-300 font-medium truncate max-w-[220px]">{{ $property->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ── Main layout ───────────────────────────── --}}
    <div class="bg-white dark:bg-charcoal-950">
        <div class="container-main py-6 lg:py-8">
            <div class="grid lg:grid-cols-3 gap-6 lg:gap-10">

                {{-- ── LEFT COLUMN ─────────────────────── --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- ── Gallery ─────────────────────── --}}
                    <div class="grid grid-cols-3 gap-2.5 rounded-lg overflow-hidden h-56 sm:h-72 lg:h-[380px]">
                        {{-- Main image --}}
                        <div class="col-span-2 relative overflow-hidden cursor-pointer" onclick="openLightbox(0)">
                            <img src="{{ $allPhotos[0] }}"
                                 alt="{{ $property->title }}"
                                 class="w-full h-full object-cover hover:scale-[1.02] transition-transform duration-500">
                            {{-- listing type badge --}}
                            <div class="absolute top-3 left-3 flex gap-1.5">
                                @if(($property->listing_type ?? 'dijual') === 'disewa')
                                    <span class="badge text-white backdrop-blur-sm" style="background-color:rgba(234,88,12,0.95);">🔑 Disewakan</span>
                                @else
                                    <span class="badge text-white backdrop-blur-sm" style="background-color:rgba(6,182,212,0.95);">🏷️ Dijual</span>
                                @endif
                                @foreach($property->conditions as $cond)
                                    <span class="{{ $cond->slug === 'baru' ? 'badge-new' : 'badge-second' }}">{{ $cond->name }}</span>
                                @endforeach
                                @if($property->is_featured)
                                    <span class="badge bg-red-600/90 text-white backdrop-blur-sm">🔥 Hotsale</span>
                                @endif
                            </div>
                        </div>

                        {{-- Side thumbnails --}}
                        <div class="flex flex-col gap-2.5">
                            {{-- Thumbnail 1 --}}
                            <div class="flex-1 overflow-hidden relative cursor-pointer"
                                 onclick="openLightbox({{ count($allPhotos) > 1 ? 1 : 0 }})">
                                <img src="{{ $allPhotos[1] ?? $allPhotos[0] }}"
                                     alt="Foto 2" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            {{-- Thumbnail 2 / "Lihat Semua Foto" button --}}
                            <div class="flex-1 overflow-hidden relative cursor-pointer" onclick="openLightbox({{ count($allPhotos) > 2 ? 2 : 0 }})">
                                <img src="{{ $allPhotos[2] ?? $allPhotos[0] }}"
                                     alt="Foto 3" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @if(count($allPhotos) > 3)
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <p class="text-lg font-bold">+{{ count($allPhotos) - 3 }}</p>
                                        <p class="text-xs">Foto</p>
                                    </div>
                                </div>
                                @elseif(count($allPhotos) >= 3)
                                {{-- No overlay needed, just show the image --}}
                                @else
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                    <p class="text-white text-xs font-medium text-center px-2">Lihat Semua</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- "Lihat semua foto" link --}}
                    @if(count($allPhotos) > 1)
                    <button type="button" onclick="openLightbox(0)"
                            class="flex items-center gap-1.5 text-xs text-brand-600 dark:text-brand-400 hover:underline font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h7"/>
                        </svg>
                        Lihat semua {{ count($allPhotos) }} foto
                    </button>
                    @endif

                    {{-- ── Title & Price ─────────────────── --}}
                    <div class="border border-gray-200 dark:border-charcoal-800 rounded-lg p-5 lg:p-6">
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            {{-- listing type badge --}}
                            @if(($property->listing_type ?? 'dijual') === 'disewa')
                                <span class="px-2.5 py-0.5 text-[11px] uppercase tracking-wider font-bold rounded-md border" style="background-color:rgba(234,88,12,0.1); color:#ea580c; border-color:rgba(234,88,12,0.3);">
                                    🔑 Disewakan
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 text-[11px] uppercase tracking-wider font-bold rounded-md border" style="background-color:rgba(6,182,212,0.1); color:#0891b2; border-color:rgba(6,182,212,0.35);">
                                    🏷️ Dijual
                                </span>
                            @endif

                            @if($property->categories->count())
                                @foreach($property->categories as $cat)
                                    <a href="{{ route('category.show', $cat->slug) }}" class="badge-gold hover:opacity-80 transition-opacity">{{ $cat->name }}</a>
                                @endforeach
                            @endif
                            
                            @if($property->property_condition)
                                @php
                                    $condColors = [
                                        'baru' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800/50',
                                        'second' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800/50',
                                        'aset-bank' => 'bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-900/20 dark:text-purple-400 dark:border-purple-800/50'
                                    ];
                                    $condLabels = [
                                        'baru' => '✨ Baru',
                                        'second' => '🔄 Second',
                                        'aset-bank' => '🏦 Aset Bank'
                                    ];
                                    $colorClass = $condColors[$property->property_condition] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                                    $label = $condLabels[$property->property_condition] ?? ucfirst($property->property_condition);
                                @endphp
                                <span class="px-2 py-0.5 text-[11px] uppercase tracking-wider font-bold rounded-md border {{ $colorClass }}">
                                    {{ $label }}
                                </span>
                            @endif
                        </div>

                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-serif font-bold text-gray-900 dark:text-white leading-tight mb-2">
                            {{ $property->title }}
                        </h1>

                        @if($property->city || $property->district)
                            <p class="flex items-center gap-1.5 text-sm text-gray-500 dark:text-charcoal-400 mb-5">
                                <svg class="w-4 h-4 text-brand-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $property->location_label }}
                            </p>
                        @endif

                        <div class="flex items-baseline gap-2 pt-4 border-t border-gray-100 dark:border-charcoal-800">
                            <p class="text-xs text-gray-400 dark:text-charcoal-500">Harga</p>
                            <p class="text-2xl sm:text-3xl font-bold text-brand-600 dark:text-brand-400">
                                {{ $property->formatted_price }}
                                @if(($property->listing_type ?? 'dijual') === 'disewa' && !empty($property->rent_period))
                                    <span class="text-sm font-normal text-gray-500 dark:text-charcoal-400">/ {{ ucfirst($property->rent_period) }}</span>
                                @elseif($property->property_type === 'tanah')
                                    @if(($property->price_type ?? 'total') === 'per_m2')
                                        <span class="text-sm font-normal text-gray-500 dark:text-charcoal-400">/ m²</span>
                                    @else
                                        <span class="text-sm font-normal text-gray-500 dark:text-charcoal-400">(Total)</span>
                                    @endif
                                @elseif($property->property_type === 'ruko' && ($property->price_type ?? 'total') === 'per_m2')
                                    <span class="text-sm font-normal text-gray-500 dark:text-charcoal-400">/ m²</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- ── Specs ─────────────────────────── --}}
                    <div class="border border-gray-200 dark:border-charcoal-800 rounded-lg p-5">
                        <h2 class="text-xs font-semibold text-gray-500 dark:text-charcoal-400 uppercase tracking-wider mb-4">Spesifikasi</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @if($property->bedrooms > 0)
                                <div class="bg-gray-50 dark:bg-charcoal-900 rounded-md p-3 flex flex-col items-center justify-center text-center">
                                    <svg class="w-6 h-6 text-brand-500 mb-1.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 10V7a2 2 0 012-2h12a2 2 0 012 2v3M4 10h16v5a1 1 0 01-1 1H5a1 1 0 01-1-1v-5zM6 16v2M18 16v2"/>
                                    </svg>
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $property->bedrooms }}</p>
                                    <p class="text-xs text-gray-500 dark:text-charcoal-400 mt-0.5">Kamar Tidur</p>
                                </div>
                            @endif
                            @if($property->bathrooms > 0)
                                <div class="bg-gray-50 dark:bg-charcoal-900 rounded-md p-3 flex flex-col items-center justify-center text-center">
                                    <svg class="w-6 h-6 text-brand-500 mb-1.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16M4 12a2 2 0 00-2 2v2a2 2 0 002 2h16a2 2 0 002-2v-2a2 2 0 00-2-2M8 18v2M16 18v2M7 12V8a2 2 0 012-2h1m4 0h3a2 2 0 012 2v4"/>
                                    </svg>
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $property->bathrooms }}</p>
                                    <p class="text-xs text-gray-500 dark:text-charcoal-400 mt-0.5">Kamar Mandi</p>
                                </div>
                            @endif
                            <div class="bg-gray-50 dark:bg-charcoal-900 rounded-md p-3 flex flex-col items-center justify-center text-center">
                                <svg class="w-6 h-6 text-brand-500 mb-1.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-2V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                </svg>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($property->land_area, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 dark:text-charcoal-400 mt-0.5">m² Tanah</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-charcoal-900 rounded-md p-3 flex flex-col items-center justify-center text-center">
                                <svg class="w-6 h-6 text-brand-500 mb-1.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($property->build_area, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 dark:text-charcoal-400 mt-0.5">m² Bangunan</p>
                            </div>
                        </div>
                    </div>

                    {{-- ── Description ─────────────────── --}}
                    <div class="border border-gray-200 dark:border-charcoal-800 rounded-lg p-5">
                        <h2 class="text-xs font-semibold text-gray-500 dark:text-charcoal-400 uppercase tracking-wider mb-3">Deskripsi Properti</h2>
                        <div class="text-sm text-gray-600 dark:text-charcoal-300 leading-relaxed whitespace-pre-line">
                            {{ $property->description }}
                        </div>
                    </div>

                    {{-- ── Share ────────────────────────── --}}
                    <div class="border border-gray-200 dark:border-charcoal-800 rounded-lg p-4 flex items-center gap-3">
                        <span class="text-xs text-gray-400 dark:text-charcoal-500 font-medium">Bagikan:</span>
                        <button onclick="navigator.clipboard.writeText(window.location.href); this.textContent='✓ Tersalin!'; setTimeout(()=>this.textContent='Salin Link',2000)"
                                class="text-xs px-3 py-1.5 border border-gray-200 dark:border-charcoal-700 rounded-md text-gray-600 dark:text-charcoal-300 hover:border-gray-300 dark:hover:border-charcoal-600 transition-colors">
                            Salin Link
                        </button>
                        <a href="https://wa.me/?text={{ urlencode($property->title . ' — ' . request()->url()) }}"
                           target="_blank" class="text-xs px-3 py-1.5 bg-[#25D366]/10 text-[#25D366] border border-[#25D366]/30 rounded-md hover:bg-[#25D366]/20 transition-colors">
                            Bagikan via WA
                        </a>
                    </div>
                </div>

                {{-- ── RIGHT COLUMN (sticky) ───────────── --}}
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-24 space-y-4">

                        {{-- WA CTA --}}
                        <div class="border-2 border-brand-200 dark:border-brand-800/60 rounded-lg p-5 bg-brand-50/40 dark:bg-brand-900/10">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">Tertarik dengan properti ini?</h3>
                            <p class="text-xs text-gray-500 dark:text-charcoal-400 mb-4 leading-relaxed">
                                Hubungi agen kami untuk informasi, jadwal survey, atau penawaran harga.
                            </p>
                            <a href="{{ $property->whatsapp_url }}"
                               target="_blank" rel="noopener noreferrer"
                               class="btn-wa w-full justify-center py-2.5 text-sm mb-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Chat WhatsApp
                            </a>
                            <p class="text-center text-[10px] text-gray-400 dark:text-charcoal-500">Pesan otomatis berisi detail properti ini</p>
                        </div>

                        {{-- Quick info --}}
                        <div class="border border-gray-200 dark:border-charcoal-800 rounded-lg p-5">
                            <h3 class="text-xs font-semibold text-gray-500 dark:text-charcoal-400 uppercase tracking-wider mb-3">Informasi</h3>
                            <ul class="divide-y divide-gray-100 dark:divide-charcoal-800 text-sm">
                                <li class="flex justify-between py-2">
                                    <span class="text-gray-500 dark:text-charcoal-400">ID Properti</span>
                                    <span class="font-medium text-gray-800 dark:text-white">{{ $property->property_code }}</span>
                                </li>
                                <li class="flex justify-between py-2">
                                    <span class="text-gray-500 dark:text-charcoal-400">Diposting</span>
                                    <span class="font-medium text-gray-800 dark:text-white">{{ $property->created_at->diffForHumans() }}</span>
                                </li>
                                <li class="flex justify-between py-2">
                                    <span class="text-gray-500 dark:text-charcoal-400">Diperbarui</span>
                                    <span class="font-medium text-gray-800 dark:text-white">{{ $property->updated_at->diffForHumans() }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Related properties ──────────────────────── --}}
    @if($relatedProperties->count() > 0)
    <section class="bg-gray-50 dark:bg-charcoal-900/50 border-t border-gray-200 dark:border-charcoal-800 py-12">
        <div class="container-main">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-serif font-bold text-gray-900 dark:text-white">Properti Serupa</h2>
                <a href="{{ route('home') }}#properties" class="text-sm text-brand-600 dark:text-brand-400 hover:underline">Lihat semua</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($relatedProperties as $relProp)
                    @include('components.property-card', ['property' => $relProp])
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ── Mobile WA sticky bar (compact) ──────────── --}}
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 dark:bg-charcoal-950/95 backdrop-blur border-t border-gray-200 dark:border-charcoal-800 px-4 py-2.5 safe-area-bottom">
        <a href="{{ $property->whatsapp_url }}" target="_blank" rel="noopener noreferrer"
           class="flex items-center justify-center gap-2 w-full py-2.5 bg-[#25D366] hover:bg-[#1ebe5d] text-white text-sm font-semibold rounded-md transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Tanyakan via WhatsApp
        </a>
    </div>
    <div class="lg:hidden h-16"></div>

</div>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- LIGHTBOX MODAL                                          --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<div id="lightbox"
     class="fixed inset-0 z-[200] bg-black/95 flex-col items-center justify-center hidden"
     role="dialog" aria-modal="true" aria-label="Galeri Foto">

    {{-- Close --}}
    <button onclick="closeLightbox()"
            class="absolute top-4 right-4 z-10 p-2 text-white/70 hover:text-white bg-black/30 rounded-full transition-colors"
            aria-label="Tutup">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    {{-- Counter --}}
    <div id="lb-counter" class="absolute top-4 left-4 text-sm text-white/60 font-medium"></div>

    {{-- Main image --}}
    <div class="flex-1 flex items-center justify-center w-full px-14 py-10 min-h-0">
        <img id="lb-img" src="" alt=""
             class="max-w-full max-h-full object-contain rounded-md shadow-2xl select-none"
             draggable="false">
    </div>

    {{-- Prev / Next --}}
    <button onclick="lbPrev()"
            class="absolute left-2 top-1/2 -translate-y-1/2 p-3 text-white/70 hover:text-white bg-black/30 hover:bg-black/50 rounded-full transition-colors"
            aria-label="Foto sebelumnya">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button onclick="lbNext()"
            class="absolute right-2 top-1/2 -translate-y-1/2 p-3 text-white/70 hover:text-white bg-black/30 hover:bg-black/50 rounded-full transition-colors"
            aria-label="Foto berikutnya">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Thumbnail strip --}}
    <div class="w-full px-4 pb-4 flex gap-2 overflow-x-auto justify-center" id="lb-thumbs"></div>
</div>

<script>
const lbPhotos = @json($allPhotos);
let lbIndex   = 0;
let touchStartX = 0;

const lightbox  = document.getElementById('lightbox');
const lbImg     = document.getElementById('lb-img');
const lbCounter = document.getElementById('lb-counter');
const lbThumbs  = document.getElementById('lb-thumbs');

function openLightbox(index) {
    lbIndex = index;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
    lbUpdate();
    buildThumbs();
}

function closeLightbox() {
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = '';
}

function lbUpdate() {
    lbImg.src = lbPhotos[lbIndex];
    lbCounter.textContent = (lbIndex + 1) + ' / ' + lbPhotos.length;
    // Highlight active thumb
    document.querySelectorAll('.lb-thumb').forEach((t, i) => {
        t.classList.toggle('ring-2', i === lbIndex);
        t.classList.toggle('ring-brand-400', i === lbIndex);
        t.classList.toggle('opacity-100', i === lbIndex);
        t.classList.toggle('opacity-50', i !== lbIndex);
    });
}

function buildThumbs() {
    if (lbThumbs.children.length > 0) return; // already built
    lbPhotos.forEach((src, i) => {
        const img = document.createElement('img');
        img.src = src;
        img.alt = 'Foto ' + (i + 1);
        img.className = 'lb-thumb h-12 w-16 object-cover rounded cursor-pointer flex-shrink-0 transition-opacity';
        img.classList.add(i === lbIndex ? 'opacity-100' : 'opacity-50');
        img.addEventListener('click', () => { lbIndex = i; lbUpdate(); });
        lbThumbs.appendChild(img);
    });
}

function lbNext() { lbIndex = (lbIndex + 1) % lbPhotos.length; lbUpdate(); }
function lbPrev() { lbIndex = (lbIndex - 1 + lbPhotos.length) % lbPhotos.length; lbUpdate(); }

// Keyboard navigation
document.addEventListener('keydown', e => {
    if (lightbox.classList.contains('hidden')) return;
    if (e.key === 'ArrowRight') lbNext();
    if (e.key === 'ArrowLeft')  lbPrev();
    if (e.key === 'Escape')     closeLightbox();
});

// Touch swipe
lightbox.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
lightbox.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) diff > 0 ? lbNext() : lbPrev();
}, { passive: true });

// Click outside image to close
lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
</script>

@endsection
