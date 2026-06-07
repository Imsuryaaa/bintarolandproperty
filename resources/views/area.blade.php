@extends('layouts.app')

@section('title', $areaData['title'] . ' – Bintaro Land Property')

@section('content')

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- HERO BANNER                                   --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section class="relative pt-16 lg:pt-[68px] overflow-hidden min-h-[50vh] flex items-center">
    <div class="absolute inset-0">
        <img src="{{ $areaData['image'] }}"
             alt="{{ $areaData['title'] }}"
             fetchpriority="high"
             class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-charcoal-950/80"></div>
    </div>

    <div class="relative z-10 container-main py-12 text-center max-w-3xl mx-auto">
        <p class="text-brand-400 text-xs font-semibold tracking-[0.18em] uppercase mb-4">Area Favorit</p>
        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-5">
            {{ $areaData['title'] }}
        </h1>
        <p class="text-gray-300 text-base leading-relaxed">
            {{ $areaData['description'] }}
        </p>
    </div>
</section>

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
{{-- GROUPED LISTINGS                              --}}
{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<section class="py-12 lg:py-16 bg-white dark:bg-charcoal-950 min-h-screen">
    <div class="container-main space-y-16">
        
        @php
            $hasAnyProperties = false;
        @endphp

        @foreach($areaData['districts'] as $districtName => $clusters)
            @if(isset($groupedProperties[$districtName]) && count($groupedProperties[$districtName]) > 0)
                @php $hasAnyProperties = true; @endphp
                <div class="district-section">
                    
                    {{-- District Header --}}
                    <div class="flex items-center gap-4 mb-8">
                        <h2 class="text-2xl lg:text-3xl font-serif font-bold text-gray-900 dark:text-white">
                            {{ $districtName }}
                        </h2>
                        <div class="h-px flex-1 bg-gray-200 dark:bg-charcoal-800"></div>
                    </div>

                    {{-- Clusters inside this District --}}
                    <div class="space-y-12">
                        @foreach($groupedProperties[$districtName] as $group)
                            @php
                                $clusterName = $group['cluster']['name'];
                                $properties = $group['properties'];
                                $mainSlug = $group['main_slug'];
                            @endphp

                            <div class="cluster-section">
                                <div class="flex items-end justify-between mb-5">
                                    <div>
                                        <p class="text-sm font-medium text-brand-600 dark:text-brand-400 mb-1">Kawasan {{ $districtName }}</p>
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-charcoal-100">
                                            {{ $clusterName }}
                                        </h3>
                                    </div>
                                    <a href="{{ route('category.show', $mainSlug) }}" class="text-sm text-brand-600 dark:text-brand-400 font-medium hover:underline flex items-center gap-1">
                                        <span class="hidden sm:inline">Lihat semua di {{ $clusterName }}</span>
                                        <span class="sm:hidden">Lihat semua</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>

                                {{-- Horizontal Scroll or Grid for Properties --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                                    @foreach($properties as $property)
                                        @include('components.property-card', ['property' => $property])
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        @if(!$hasAnyProperties)
            <div class="text-center py-20 border border-dashed border-gray-200 dark:border-charcoal-700 rounded-xl">
                <svg class="w-12 h-12 text-gray-300 dark:text-charcoal-600 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
                <p class="text-gray-500 dark:text-charcoal-400 text-base mb-4">Saat ini belum ada listing properti yang tersedia untuk area ini.</p>
                <a href="{{ route('home') }}" class="btn-primary text-sm px-6">Kembali ke Beranda</a>
            </div>
        @endif

    </div>
</section>

@endsection
