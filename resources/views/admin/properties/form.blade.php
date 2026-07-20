@extends('layouts.admin')

@section('title', isset($property) ? 'Edit Properti' : 'Tambah Properti')
@section('page-title', isset($property) ? 'Edit Properti' : 'Tambah Properti')

@section('content')

<div class="flex flex-col xl:flex-row gap-6 items-start">
    <div class="w-full xl:w-[65%] 2xl:w-2/3 max-w-4xl">
        <div class="mb-5">
            <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke daftar
            </a>
        </div>

    <form method="POST"
          action="{{ isset($property) ? route('admin.properties.update', $property) : route('admin.properties.store') }}"
          enctype="multipart/form-data"
          class="space-y-5"
          id="property-form"
          x-data="{
              propertyType: '{{ old('property_type', $property->property_type ?? 'rumah') }}',
              listingType: '{{ old('listing_type', $property->listing_type ?? 'dijual') }}',
              rentPeriod: '{{ old('rent_period', $property->rent_period ?? 'tahun') }}',
              priceType: '{{ old('price_type', $property->price_type ?? 'total') }}',
              showAdditional: false
          }">
        @csrf
        @if(isset($property))
            @method('PUT')
        @endif

        {{-- Hidden field to send photo sort order --}}
        <input type="hidden" name="photo_order" id="photo-order-input">

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-sm text-red-700 dark:text-red-400">
            <p class="font-medium mb-1">Terdapat kesalahan pada form:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @if(!isset($property))
            <p class="mt-3 font-bold text-red-800 dark:text-red-300">⚠️ PENTING: Anda harus memilih kembali foto properti karena foto akan ter-reset saat terjadi error validasi.</p>
            @endif
        </div>
        @endif

        {{-- Duplicate Property Code Error --}}
        @if(session('duplicate_error') && session('duplicate_property'))
        @php $dupProp = session('duplicate_property'); @endphp
        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-sm text-red-700 dark:text-red-400 flex items-start gap-4">
            @if($dupProp->photos->isNotEmpty())
                <img src="{{ $dupProp->photos->first()->url }}" alt="Cover" class="w-20 h-20 object-cover rounded-lg border border-red-200 dark:border-red-800">
            @endif
            <div>
                <p class="font-bold text-red-800 dark:text-red-300 mb-1">Kode Properti Sudah Terpakai!</p>
                <p class="mb-2">Kode <strong>{{ old('property_code') }}</strong> sudah digunakan oleh properti: <br><span class="font-semibold">{{ $dupProp->title }}</span></p>
                <a href="{{ route('admin.properties.edit', $dupProp) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-100 px-3 py-1.5 rounded-md hover:bg-red-200 dark:hover:bg-red-700 transition-colors">
                    Lihat Properti Tersebut
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </div>
        @endif

        <!-- ── Tipe Iklan ────────────────────────────────────────────── -->
        <input type="hidden" name="listing_type" :value="listingType">
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 mb-4 border-b border-gray-100 dark:border-gray-800">
                Tipe Iklan <span class="text-red-500">*</span>
            </h2>
            <div class="flex flex-wrap gap-2">
                <button type="button" @click="listingType = 'dijual'"
                        :class="listingType === 'dijual' ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 shadow-sm' : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500'"
                        class="flex items-center gap-2 px-6 py-2.5 rounded-lg border-2 text-sm font-bold transition-all duration-150">
                    Dijual
                </button>
                <button type="button" @click="listingType = 'disewa'"
                        :class="listingType === 'disewa' ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 shadow-sm' : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500'"
                        class="flex items-center gap-2 px-6 py-2.5 rounded-lg border-2 text-sm font-bold transition-all duration-150">
                    Disewa
                </button>
            </div>
        </div>

        <!-- ── Tipe Properti ─────────────────────────────────────────── -->
        <input type="hidden" name="property_type" id="property_type_input" :value="propertyType">

        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5">
            @php
                $selectedCondition = old('property_condition', $property->property_condition ?? 'baru');
                $condColors = [
                    'baru'      => ['active' => 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400', 'inactive' => ''],
                    'second'    => ['active' => 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400',       'inactive' => ''],
                    'aset-bank' => ['active' => 'border-purple-500 bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400', 'inactive' => ''],
                ];
                $inactiveClass = 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500';
            @endphp
            <input type="hidden" name="property_condition" id="property_condition_input" value="{{ $selectedCondition }}">

            {{-- Row 1: Tipe --}}
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 mb-4 border-b border-gray-100 dark:border-gray-800">
                Tipe Properti <span class="text-red-500">*</span>
            </h2>
            <div class="flex flex-wrap gap-2 mb-5" id="property-type-selector">
                @foreach(\App\Models\Property::TYPES as $typeKey => $typeDef)
                <button type="button"
                        @click="propertyType = '{{ $typeKey }}'"
                        :class="propertyType === '{{ $typeKey }}' ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 shadow-sm' : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500'"
                        class="type-btn flex items-center gap-2 px-3.5 py-2 rounded-lg border-2 text-sm font-medium transition-all duration-150"
                        data-type="{{ $typeKey }}">
                    <span class="text-base leading-none">{{ $typeDef['icon'] }}</span>
                    <span>{{ $typeDef['label'] }}</span>
                </button>
                @endforeach
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 dark:border-gray-800 mb-4"></div>

            {{-- Row 2: Kondisi --}}
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                Kondisi Properti <span class="text-red-500">*</span>
            </h2>
            <div class="flex flex-wrap gap-2" id="property-condition-selector">
                @foreach(\App\Models\Property::CONDITIONS as $condKey => $condDef)
                <button type="button"
                        class="cond-btn flex items-center gap-2 px-4 py-2.5 rounded-lg border-2 text-sm font-semibold transition-all duration-150 shadow-sm
                               {{ $selectedCondition === $condKey
                                  ? $condColors[$condKey]['active'] . ' shadow-md'
                                  : $inactiveClass }}"
                        data-condition="{{ $condKey }}">
                    <span class="text-base leading-none">{{ $condDef['icon'] }}</span>
                    <span>{{ $condDef['label'] }}</span>
                </button>
                @endforeach
            </div>
        </div>

        <!-- ── Informasi Dasar ──────────────────────────────────────── -->
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 space-y-4 mt-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 border-b border-gray-100 dark:border-gray-800">Informasi Dasar</h2>


            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @php
                    $oldCode = old('property_code', $property->property_code ?? '');
                    $oldPrefix = 'SP';
                    $oldNumber = '';
                    if (preg_match('/^(SPL|SPJ|SP)\s*(.*)$/i', $oldCode, $matches)) {
                        $oldPrefix = strtoupper($matches[1]);
                        $oldNumber = $matches[2];
                    } else {
                        $oldNumber = $oldCode;
                    }
                @endphp
                <div x-data="{ prefix: '{{ $oldPrefix }}', number: '{{ $oldNumber }}' }">
                    <label for="property_code" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Kode Listing <span class="text-red-500">*</span></label>
                    <div class="flex">
                        <select x-model="prefix" class="px-3 py-2.5 rounded-l-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent cursor-pointer font-medium border-r-0" style="min-width: 80px;">
                            <option value="SP">SP</option>
                            <option value="SPL">SPL</option>
                            <option value="SPJ">SPJ</option>
                        </select>
                        <input type="text" x-model="number"
                               class="w-full px-3 py-2.5 rounded-r-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent uppercase"
                               placeholder="Contoh: 1009" required>
                        <input type="hidden" name="property_code" :value="prefix + number">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="title" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Nama Properti <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $property->title ?? '') }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           placeholder="Contoh: Rumah Minimalis 2 Lantai di Bintaro Sektor 7" required>
                </div>
            </div>

            <div>
                <label for="description" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent resize-none"
                          placeholder="Deskripsikan properti ini..." required>{{ old('description', $property->description ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    
                    {{-- Rent Period (Disewa) --}}
                    <div x-show="listingType === 'disewa'" style="display: none;" class="flex items-center gap-2 mb-2 bg-gray-50 dark:bg-gray-800/50 p-1.5 rounded-lg border border-gray-200 dark:border-gray-700 w-fit">
                        <input type="hidden" name="rent_period" :value="rentPeriod">
                        <template x-for="period in ['Tahun', 'Bulan', 'Hari']">
                            <button type="button" @click="rentPeriod = period.toLowerCase()"
                                    :class="rentPeriod === period.toLowerCase() ? 'bg-white dark:bg-gray-700 shadow-sm text-amber-600 dark:text-amber-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                                    class="px-3 py-1 rounded-md text-xs font-medium transition-all">
                                Per <span x-text="period"></span>
                            </button>
                        </template>
                    </div>

                    {{-- Price Type (Tanah/Ruko) --}}
                    <div x-show="propertyType === 'tanah' || propertyType === 'ruko'" style="display: none;" class="mb-2 w-fit">
                        <select name="price_type" x-model="priceType"
                                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 text-gray-900 dark:text-white text-xs focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium cursor-pointer">
                            <option value="total">Harga Total</option>
                            <option value="per_m2">Harga Per m²</option>
                        </select>
                    </div>

                    @php
                        $priceUnit = 'Juta';
                        $priceVal = '';
                        if(old('price_value')) {
                            $priceVal = old('price_value');
                            $priceUnit = old('price_unit', 'Juta');
                        } elseif(isset($property) && $property->price > 0) {
                            $p = (float)$property->price;
                            if($p >= 1000000000000) { $priceVal = $p / 1000000000000; $priceUnit = 'Triliun'; }
                            elseif($p >= 1000000000) { $priceVal = $p / 1000000000; $priceUnit = 'Miliar'; }
                            elseif($p >= 1000000) { $priceVal = $p / 1000000; $priceUnit = 'Juta'; }
                            else { $priceVal = $p / 1000; $priceUnit = 'Ribu'; }
                            $priceVal = str_replace('.', ',', (string)$priceVal);
                        }
                    @endphp
                    <div class="flex">
                        <input type="text" id="price_value" name="price_value" value="{{ $priceVal }}"
                               class="w-full px-3 py-2.5 rounded-l-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent border-r-0"
                               placeholder="7,5" required
                               maxlength="6"
                               inputmode="decimal"
                               autocomplete="off">
                        <select name="price_unit" class="px-3 py-2.5 rounded-r-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent cursor-pointer font-medium">
                            <option value="Ribu" {{ $priceUnit == 'Ribu' ? 'selected' : '' }}>Ribu</option>
                            <option value="Juta" {{ $priceUnit == 'Juta' ? 'selected' : '' }}>Juta</option>
                            <option value="Miliar" {{ $priceUnit == 'Miliar' ? 'selected' : '' }}>Miliar</option>
                            <option value="Triliun" {{ $priceUnit == 'Triliun' ? 'selected' : '' }}>Triliun</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Lokasi ───────────────────────────────────────────────── -->
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 space-y-4 mt-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 border-b border-gray-100 dark:border-gray-800">Lokasi</h2>

            <div class="relative">
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Masukan Lokasi Iklan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </span>
                    <input type="text" id="location_autocomplete" autocomplete="off"
                           class="w-full pl-10 px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           placeholder="Ketik lokasi, misal: Bintaro...">
                    <button type="button" id="clear_location" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 hidden">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <!-- Autocomplete Dropdown -->
                <div id="location_suggestions" class="absolute z-10 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                    <!-- Suggestions will be populated via JS -->
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="province" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Provinsi <span class="text-emerald-500 text-[10px] ml-1 bg-emerald-50 dark:bg-emerald-900/20 px-1.5 py-0.5 rounded">Wajib</span></label>
                    <input type="text" id="province" name="province" value="{{ old('province', $property->province ?? '') }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           placeholder="Provinsi" required>
                </div>
                <div>
                    <label for="city" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Kota <span class="text-emerald-500 text-[10px] ml-1 bg-emerald-50 dark:bg-emerald-900/20 px-1.5 py-0.5 rounded">Wajib</span></label>
                    <input type="text" id="city" name="city" value="{{ old('city', $property->city ?? '') }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           placeholder="Kota" required>
                </div>
            </div>

            <div>
                <label for="district" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Area/Kelurahan/Nama Cluster <span class="text-emerald-500 text-[10px] ml-1 bg-emerald-50 dark:bg-emerald-900/20 px-1.5 py-0.5 rounded">Wajib</span></label>
                <input type="text" id="district" name="district" value="{{ old('district', $property->district ?? '') }}"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                       placeholder="Area atau Kelurahan" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="complex_name" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5" x-text="propertyType === 'apartemen' ? 'Nama Apartemen' : 'Komplek Perumahan'">Komplek Perumahan</label>
                    <input type="text" id="complex_name" name="complex_name" value="{{ old('complex_name', $property->complex_name ?? '') }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           :placeholder="propertyType === 'apartemen' ? 'Contoh: Apartemen Bintaro Icon' : 'Pilih atau ketik Komplek Perumahan'">
                </div>
                <div>
                    <label for="street_name" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Nama Jalan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </span>
                        <input type="text" id="street_name" name="street_name" value="{{ old('street_name', $property->street_name ?? '') }}"
                               class="w-full pl-10 px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                               placeholder="Contoh: Jalan Merdeka">
                    </div>
                    <p class="text-[10px] text-gray-500 mt-1.5 ml-1 flex items-start gap-1">
                        <span class="text-amber-500">💡</span> Nama jalan tidak ditampilkan kepada konsumen, tapi membantu algoritma pencarian.
                    </p>
                </div>
            </div>
        </div>

        <!-- ── Spesifikasi ──────────────────────────────────────────── -->
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 space-y-4 mt-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 border-b border-gray-100 dark:border-gray-800">Spesifikasi</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4" id="spec-counter-grid" x-show="propertyType !== 'tanah' && propertyType !== 'ruang-usaha'">
                <div data-spec="bedrooms" x-show="!['tanah','gudang','pabrik','ruko','hotel','perkantoran','ruang-usaha'].includes(propertyType)">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5 text-center">Kamar Tidur</label>
                    <div class="flex items-center justify-between border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                        <button type="button" class="btn-decrement flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="bedrooms">&minus;</button>
                        <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms ?? 0) }}"
                               class="w-full text-center py-2.5 text-sm font-semibold text-gray-900 dark:text-white bg-white dark:bg-gray-800 border-x border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-0 pointer-events-none [-moz-appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                               min="0" readonly>
                        <button type="button" class="btn-increment flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="bedrooms">&plus;</button>
                    </div>
                </div>
                <div data-spec="bathrooms" x-show="!['tanah','gudang','pabrik','ruko','hotel','perkantoran','ruang-usaha'].includes(propertyType)">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5 text-center">Kamar Mandi</label>
                    <div class="flex items-center justify-between border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                        <button type="button" class="btn-decrement flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="bathrooms">&minus;</button>
                        <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms ?? 0) }}"
                               class="w-full text-center py-2.5 text-sm font-semibold text-gray-900 dark:text-white bg-white dark:bg-gray-800 border-x border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-0 pointer-events-none [-moz-appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                               min="0" readonly>
                        <button type="button" class="btn-increment flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="bathrooms">&plus;</button>
                    </div>
                </div>
                <div data-spec="floors" x-show="!['tanah'].includes(propertyType)">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5 text-center">Jml Lantai</label>
                    <div class="flex items-center justify-between border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                        <button type="button" class="btn-decrement flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="floors" data-min="1">&minus;</button>
                        <input type="number" id="floors" name="floors" value="{{ old('floors', $property->floors ?? 1) }}"
                               class="w-full text-center py-2.5 text-sm font-semibold text-gray-900 dark:text-white bg-white dark:bg-gray-800 border-x border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-0 pointer-events-none [-moz-appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                               min="1" readonly>
                        <button type="button" class="btn-increment flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="floors">&plus;</button>
                    </div>
                </div>
                <div data-spec="garages" x-show="!['apartemen','tanah','hotel','perkantoran','ruang-usaha','kost'].includes(propertyType)">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5 text-center">Garasi</label>
                    <div class="flex items-center justify-between border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                        <button type="button" class="btn-decrement flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="garages">&minus;</button>
                        <input type="number" id="garages" name="garages" value="{{ old('garages', $property->garages ?? 0) }}"
                               class="w-full text-center py-2.5 text-sm font-semibold text-gray-900 dark:text-white bg-white dark:bg-gray-800 border-x border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-0 pointer-events-none [-moz-appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                               min="0" readonly>
                        <button type="button" class="btn-increment flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="garages">&plus;</button>
                    </div>
                </div>
                <div data-spec="carports" x-show="!['apartemen','tanah','ruko','gudang','pabrik','hotel','perkantoran','ruang-usaha','kost'].includes(propertyType)">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5 text-center">Carport</label>
                    <div class="flex items-center justify-between border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                        <button type="button" class="btn-decrement flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="carports">&minus;</button>
                        <input type="number" id="carports" name="carports" value="{{ old('carports', $property->carports ?? 0) }}"
                               class="w-full text-center py-2.5 text-sm font-semibold text-gray-900 dark:text-white bg-white dark:bg-gray-800 border-x border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-0 pointer-events-none [-moz-appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                               min="0" readonly>
                        <button type="button" class="btn-increment flex-shrink-0 w-9 py-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold text-lg leading-none transition-colors text-center" data-target="carports">&plus;</button>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div data-spec="land_area" x-show="propertyType !== 'apartemen'">
                    <label for="land_area" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Luas Tanah (m²)</label>
                    <input type="number" id="land_area" name="land_area" value="{{ old('land_area', $property->land_area ?? 0) }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           min="" placeholder="120">
                </div>
                <div data-spec="build_area" x-show="propertyType !== 'tanah'">
                    <label for="build_area" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Luas Bangunan (m²)</label>
                    <input type="number" id="build_area" name="build_area" value="{{ old('build_area', $property->build_area ?? 0) }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           min="" placeholder="90">
                </div>
                
                {{-- Tanah Only: Panjang & Lebar --}}
                <div x-show="propertyType === 'tanah'" style="display: none;">
                    <label for="land_length" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Panjang Tanah (m)</label>
                    <input type="number" id="land_length" name="land_length" value="{{ old('land_length', $property->land_length ?? 0) }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           min="0" placeholder="0">
                </div>
                <div x-show="propertyType === 'tanah'" style="display: none;">
                    <label for="land_width" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Lebar Tanah (m)</label>
                    <input type="number" id="land_width" name="land_width" value="{{ old('land_width', $property->land_width ?? 0) }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           min="0" placeholder="0">
                </div>
                
                {{-- Apartemen Only: Lantai, Studio, Mezanin --}}
                <div x-show="propertyType === 'apartemen'" style="display: none;">
                    <label for="floor_number" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Nomor Lantai</label>
                    <input type="text" id="floor_number" name="floor_number" value="{{ old('floor_number', $property->floor_number ?? '') }}"
                           class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           placeholder="Contoh: 12A">
                </div>
                <div x-show="propertyType === 'apartemen'" style="display: none;" class="flex items-center gap-6 mt-6">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="is_studio" value="1" class="w-4 h-4 rounded border-gray-300 text-amber-500 focus:ring-amber-500" {{ old('is_studio', $property->is_studio ?? false) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Studio</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="is_mezzanine" value="1" class="w-4 h-4 rounded border-gray-300 text-amber-500 focus:ring-amber-500" {{ old('is_mezzanine', $property->is_mezzanine ?? false) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mezanin</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- ── Detail Tambahan (Accordion) ─────────────────────────── -->
        <div x-data="{ showDetails: false }" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden mt-5 mb-5">
            <button type="button" @click="showDetails = !showDetails" class="w-full flex items-center justify-between p-5 focus:outline-none hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Detail Tambahan (Opsional)</h2>
                <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" :class="showDetails ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="showDetails" x-collapse style="display: none;" class="p-5 pt-0 border-t border-gray-100 dark:border-gray-800 mt-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Sertifikat</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="cert in ['SHM', 'HGB', 'Strata Title', 'Lainnya']">
                                <label class="cursor-pointer">
                                    <input type="radio" name="certificate" :value="cert" class="peer sr-only" :checked="'{{ old('certificate', $property->certificate ?? '') }}' === cert">
                                    <div class="px-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-700 text-xs font-medium text-gray-600 dark:text-gray-400 peer-checked:bg-amber-50 dark:peer-checked:bg-amber-900/20 peer-checked:border-amber-500 peer-checked:text-amber-700 dark:peer-checked:text-amber-400 transition-colors" x-text="cert"></div>
                                </label>
                            </template>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Tahun Dibangun</label>
                        <input type="number" name="build_year" value="{{ old('build_year', $property->build_year ?? '') }}"
                               class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                               placeholder="Contoh: 2020">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Daya Listrik (Watt)</label>
                        <input type="number" name="electricity" value="{{ old('electricity', $property->electricity ?? '') }}"
                               class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                               placeholder="Contoh: 2200">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Arah Hadap</label>
                        <select name="orientation" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <option value="">-- Pilih Arah --</option>
                            <option value="Utara" {{ old('orientation', $property->orientation ?? '') == 'Utara' ? 'selected' : '' }}>Utara</option>
                            <option value="Timur" {{ old('orientation', $property->orientation ?? '') == 'Timur' ? 'selected' : '' }}>Timur</option>
                            <option value="Selatan" {{ old('orientation', $property->orientation ?? '') == 'Selatan' ? 'selected' : '' }}>Selatan</option>
                            <option value="Barat" {{ old('orientation', $property->orientation ?? '') == 'Barat' ? 'selected' : '' }}>Barat</option>
                        </select>
                    </div>
                </div>

                <div class="mt-5">
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Fasilitas</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <template x-if="propertyType === 'apartemen'">
                            <template x-for="fas in ['Kolam Renang', 'Gym/Fitness', 'Security 24 Jam', 'Access Card', 'Parkir Basement', 'Balkon']">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" :value="fas" class="w-4 h-4 rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                    <span class="text-xs text-gray-700 dark:text-gray-300" x-text="fas"></span>
                                </label>
                            </template>
                        </template>
                        <template x-if="propertyType !== 'apartemen'">
                            <template x-for="fas in ['Taman', 'Keamanan 24 Jam', 'One Gate System', 'CCTV', 'Masuk Mobil', 'Bebas Banjir']">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" :value="fas" class="w-4 h-4 rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                    <span class="text-xs text-gray-700 dark:text-gray-300" x-text="fas"></span>
                                </label>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Kategori ────────────────────────────────────────────── -->
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 space-y-4 mt-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 border-b border-gray-100 dark:border-gray-800">Kategori Properti</h2>

            <div>
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Pilih Kategori <span class="text-red-500">*</span></label>
                <select name="category_id" class="w-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" required>
                    <option value="" disabled {{ !isset($property) && !old('category_id') ? 'selected' : '' }}>-- Pilih Kategori --</option>
                    @foreach($parentCategories as $category)
                        <optgroup label="{{ $category->name }}" class="font-bold text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800">
                            @foreach($category->children as $child)
                                <option value="{{ $child->id }}" class="font-normal text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900" {{ (isset($property) && $property->categories->contains($child->id)) || old('category_id') == $child->id ? 'selected' : '' }}>
                                    {{ $child->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- ── Foto Properti (Multi-Upload + Drag & Drop) ─────────── -->
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 space-y-4 mt-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 border-b border-gray-100 dark:border-gray-800">
                Foto Properti
                <span class="text-xs font-normal text-gray-400 ml-1">(maks 10 foto, maks 3MB/foto)</span>
            </h2>

            {{-- Existing photos (edit mode) --}}
            @if(isset($property) && $property->photos->count() > 0)
            <div>
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $property->photos->count() }} foto</span>
                        &mdash; drag ⊕ untuk ubah urutan. Foto pertama menjadi <span class="text-amber-600 font-semibold">Cover</span>.
                    </p>
                </div>
                <div id="existing-photos-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($property->photos as $photo)
                    <div class="existing-photo-card relative rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 border-2 border-transparent hover:border-amber-400 transition-colors cursor-grab active:cursor-grabbing select-none"
                         style="aspect-ratio: 1"
                         data-photo-id="{{ $photo->id }}"
                         draggable="true">

                        {{-- Image --}}
                        <img src="{{ $photo->url }}"
                             alt="Foto {{ $loop->iteration }}"
                             class="w-full h-full object-cover pointer-events-none">

                        {{-- Dark overlay bottom (always) --}}
                        <div class="absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>

                        {{-- Number badge top-left --}}
                        <div class="absolute top-1.5 left-1.5 flex items-center gap-1">
                            <span class="photo-order-badge inline-flex items-center justify-center min-w-[22px] h-[22px] px-1 rounded text-[11px] font-bold bg-black/60 text-white backdrop-blur-sm"
                                  id="order-badge-{{ $photo->id }}">
                                {{ $loop->iteration }}
                            </span>
                            @if($loop->first)
                            <span class="cover-label inline-flex items-center px-1.5 h-[22px] rounded text-[10px] font-bold bg-amber-500 text-white"
                                  id="cover-label-{{ $photo->id }}">
                                Cover
                            </span>
                            @endif
                        </div>

                        {{-- "..." menu top-right --}}
                        <div class="absolute top-1.5 right-1.5">
                            <div class="relative" x-data="false">
                                <button type="button"
                                        class="photo-menu-btn w-7 h-7 rounded-full bg-black/50 hover:bg-black/75 text-white flex items-center justify-center backdrop-blur-sm transition-colors"
                                        data-photo-id="{{ $photo->id }}"
                                        title="Opsi">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/>
                                    </svg>
                                </button>
                                <div class="photo-menu-dropdown hidden absolute right-0 top-8 z-20 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1">
                                    <button type="button"
                                            class="delete-existing-photo w-full text-left px-3 py-1.5 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2"
                                            data-photo-id="{{ $photo->id }}"
                                            data-delete-url="{{ route('admin.properties.photos.destroy', [$property, $photo]) }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus Foto
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- ⊕ Drag handle bottom-left (always visible) --}}
                        <div class="absolute bottom-1.5 left-1.5 pointer-events-none">
                            <div class="w-7 h-7 rounded-full bg-black/50 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- New photos upload drop zone --}}
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Tambah foto baru:</p>
                <label for="photos" id="drop-zone"
                       class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-amber-400 dark:hover:border-amber-500 transition-colors">
                    <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                        <span class="font-medium text-amber-600">Klik untuk pilih</span> atau drag foto ke sini<br>
                        JPG, PNG, WEBP • Maks 3MB per foto
                    </p>
                    <input type="file" id="photos" name="photos[]" multiple accept="image/*" class="hidden">
                </label>

                {{-- New photo previews --}}
                <div id="new-photos-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 mt-2.5 empty:hidden"></div>
            </div>
        </div>

        <!-- ── Opsi ─────────────────────────────────────────────────── -->
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 mt-5 mb-5">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 pb-3 border-b border-gray-100 dark:border-gray-800 mb-4">Opsi</h2>

            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" name="is_featured" value="1"
                       class="w-4 h-4 rounded border-gray-300 text-amber-500 focus:ring-amber-500"
                       {{ old('is_featured', isset($property) ? $property->is_featured : false) ? 'checked' : '' }}>
                <div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tandai sebagai Hotsale</span>
                    <p class="text-xs text-gray-400">Properti Hotsale ditampilkan di bagian atas halaman utama</p>
                </div>
            </label>
        </div>

        <!-- ── Submit ──────────────────────────────────────────────── -->
        <div class="flex items-center gap-3">
            <button type="submit" id="btn-submit-property" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg transition-colors duration-200 flex items-center gap-2">
                <span id="btn-submit-text">{{ isset($property) ? 'Simpan Perubahan' : 'Tambah Properti' }}</span>
            </button>
            <a href="{{ route('admin.properties.index') }}" class="px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                Batal
            </a>
        </div>
    </form>

    {{-- ── Loading Overlay ── --}}
    <div id="upload-overlay" class="fixed inset-0 z-[9999] hidden items-center justify-center" style="background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);">
        <div class="flex flex-col items-center gap-6 p-8">
            {{-- Circular Progress Ring --}}
            <div class="relative w-28 h-28">
                {{-- Background ring --}}
                <svg class="w-28 h-28 transform -rotate-90" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="52" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="8"/>
                    <circle id="progress-ring" cx="60" cy="60" r="52" fill="none" stroke="#f59e0b" stroke-width="8"
                            stroke-linecap="round"
                            stroke-dasharray="326.73"
                            stroke-dashoffset="326.73"
                            style="transition: stroke-dashoffset 0.4s ease;"/>
                </svg>
                {{-- Percentage text --}}
                <div class="absolute inset-0 flex items-center justify-center">
                    <span id="progress-percent" class="text-2xl font-bold text-white">0%</span>
                </div>
            </div>

            {{-- Status text --}}
            <div class="text-center">
                <p id="progress-status" class="text-white font-semibold text-sm mb-1">Mengunggah foto...</p>
                <p class="text-white/50 text-xs">Mohon tunggu, jangan tutup halaman ini</p>
            </div>

            {{-- Animated dots --}}
            <div class="flex gap-1.5">
                <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce" style="animation-delay:0s"></span>
                <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce" style="animation-delay:0.15s"></span>
                <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce" style="animation-delay:0.3s"></span>
            </div>
        </div>
    </div>

    {{-- Loading overlay script --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form      = document.getElementById('property-form');
        var overlay   = document.getElementById('upload-overlay');
        var ring      = document.getElementById('progress-ring');
        var pctText   = document.getElementById('progress-percent');
        var statusEl  = document.getElementById('progress-status');
        var btnSubmit = document.getElementById('btn-submit-property');
        var circumference = 2 * Math.PI * 52; // 326.73

        if (!form || !overlay) return;

        function setProgress(pct) {
            var offset = circumference - (pct / 100) * circumference;
            ring.style.strokeDashoffset = offset;
            pctText.textContent = Math.round(pct) + '%';
        }

        function setStatus(text) {
            statusEl.textContent = text;
        }

        form.addEventListener('submit', function(e) {
            // Check if form has photos
            var photoInputs = form.querySelectorAll('input[type="file"]');
            var hasFiles = false;
            photoInputs.forEach(function(inp) {
                if (inp.files && inp.files.length > 0) hasFiles = true;
            });

            // Show overlay
            overlay.style.display = 'flex';
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');

            // Simulate progress for traditional form submit
            var progress = 0;
            var messages = [
                { at: 0,  text: 'Memvalidasi data...' },
                { at: 15, text: 'Mengunggah foto...' },
                { at: 40, text: 'Mengkonversi ke WebP...' },
                { at: 65, text: 'Menyimpan ke database...' },
                { at: 85, text: 'Hampir selesai...' },
            ];

            if (!hasFiles) {
                messages = [
                    { at: 0,  text: 'Memvalidasi data...' },
                    { at: 30, text: 'Menyimpan ke database...' },
                    { at: 70, text: 'Hampir selesai...' },
                ];
            }

            var interval = setInterval(function() {
                // Slow down as we approach 90%
                if (progress < 30) {
                    progress += Math.random() * 4 + 1;
                } else if (progress < 60) {
                    progress += Math.random() * 2 + 0.5;
                } else if (progress < 85) {
                    progress += Math.random() * 1.5 + 0.3;
                } else if (progress < 95) {
                    progress += Math.random() * 0.5 + 0.1;
                }

                if (progress > 95) progress = 95; // Never reach 100 until page navigates

                setProgress(progress);

                // Update status message
                for (var i = messages.length - 1; i >= 0; i--) {
                    if (progress >= messages[i].at) {
                        setStatus(messages[i].text);
                        break;
                    }
                }
            }, 300);

            // When page starts unloading (redirect), jump to 100%
            window.addEventListener('beforeunload', function() {
                clearInterval(interval);
                setProgress(100);
                setStatus('Selesai! Mengalihkan...');
            });
        });
    });
    </script>
    </div>

    <!-- ── Panduan & SEO Tips (Right Sidebar) ── -->
    <div class="w-full xl:w-[35%] 2xl:w-1/3 xl:sticky xl:top-24 space-y-5">
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-amber-200 dark:border-amber-900/50 p-5 shadow-sm relative overflow-hidden">
            <!-- Decorative background blob -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-50 dark:bg-amber-900/20 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="flex items-center gap-2 mb-5 relative z-10">
                <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white text-base">Panduan SEO & Pengisian</h3>
            </div>
            
            <div class="space-y-5 text-sm text-gray-600 dark:text-gray-400 relative z-10">
                
                <!-- Judul -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-1.5 flex items-center gap-1.5">
                        <span class="text-lg">📝</span> Format Judul Properti
                    </h4>
                    <p class="leading-relaxed text-[13px] mb-2">Gunakan format jelas yang sering dicari pembeli di Google:</p>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-md p-2.5 text-[13px]">
                        <span class="font-medium text-amber-600 dark:text-amber-400">Tipe + Keunggulan + Lokasi</span>
                        <br>
                        <span class="italic text-gray-500">Contoh: "Rumah Baru Siap Huni 2 Lantai di Discovery Bintaro"</span>
                    </div>
                </div>
                
                <hr class="border-gray-100 dark:border-gray-800">
                
                <!-- Deskripsi -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-1.5 flex items-center gap-1.5">
                        <span class="text-lg">✨</span> Struktur Deskripsi
                    </h4>
                    <p class="leading-relaxed text-[13px] mb-2">Google menyukai deskripsi yang rapi dan terstruktur. Susunlah dengan urutan:</p>
                    <ul class="space-y-1.5 text-[13px]">
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500 mt-0.5">•</span>
                            <span><strong>Paragraf 1:</strong> Kalimat pembuka menarik (Hook).</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500 mt-0.5">•</span>
                            <span><strong>Paragraf 2:</strong> Selling point (Akses tol, mall, dll).</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-500 mt-0.5">•</span>
                            <span><strong>List Spesifikasi:</strong> Sertakan jika ada spesifikasi detail yang tidak ada di form.</span>
                        </li>
                    </ul>
                </div>
                
                <hr class="border-gray-100 dark:border-gray-800">
                
                <!-- Foto -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-1.5 flex items-center gap-1.5">
                        <span class="text-lg">📸</span> Tips Foto Cover
                    </h4>
                    <p class="leading-relaxed text-[13px]">
                        Algoritma website otomatis menggunakan foto urutan pertama sebagai <strong>Cover</strong>. Pastikan itu adalah foto bagian <strong>Tampak Depan (Fasad)</strong> dengan pencahayaan yang terang.
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</div>

{{-- ── Modal Pemilihan Foto (Tahap 1 sebelum masuk ke grid form) ── --}}
<div id="photo-selection-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6" aria-modal="true">
    {{-- Dark backdrop --}}
    <div id="photo-selection-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"></div>

    {{-- Modal Content --}}
    <div id="photo-selection-content" class="relative bg-white dark:bg-gray-900 w-full max-w-3xl max-h-[85vh] rounded-2xl shadow-2xl flex flex-col transform scale-95 opacity-0 transition-all duration-300">
        
        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-800">
            <button type="button" id="btn-close-modal" class="p-1.5 -ml-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 transition-colors" title="Batal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </button>
            <h3 class="text-sm font-bold text-gray-800 dark:text-gray-200" id="modal-title-count">Pilih Foto</h3>
            <label class="flex items-center gap-2 cursor-pointer group px-2 py-1 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                <span class="text-[11px] font-semibold text-brand-600 dark:text-brand-400 select-none">Pilih Semua Foto</span>
                <input type="checkbox" id="checkbox-select-all" class="w-3.5 h-3.5 rounded border-gray-300 text-brand-600 focus:ring-brand-500 focus:ring-offset-0">
            </label>
        </div>

        {{-- Body (Grid) --}}
        <div class="flex-1 overflow-y-auto p-4 bg-gray-50/50 dark:bg-gray-900/50">
            <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-3 text-center">Klik foto untuk memilih dan menentukan urutan. Foto pertama yang dipilih menjadi Cover.</p>
            <div id="staged-photos-grid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2.5">
                {{-- Di-render oleh JS --}}
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800 flex justify-center bg-white dark:bg-gray-900 rounded-b-2xl">
            <button type="button" id="btn-confirm-photos" class="w-full sm:w-auto min-w-[200px] px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-[13px] font-semibold rounded-lg shadow-sm transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <span id="btn-confirm-text">Gunakan Foto (0)</span>
            </button>
        </div>
    </div>
</div>

{{-- ── AlpineJS (jika belum diload di layout) ────────────────────────── --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
{{-- ── SortableJS ────────────────────────────────────────────────── --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken      = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    const photoOrderInput = document.getElementById('photo-order-input');
    const existingGrid   = document.getElementById('existing-photos-grid');
    const previewGrid    = document.getElementById('new-photos-preview');
    const photoInput     = document.getElementById('photos');

    /* ════════════════════════════════════════════════════════════
     * 1. EXISTING PHOTOS — Sortable + number badges + menu
     * ════════════════════════════════════════════════════════════ */
    if (existingGrid) {

        /* -- Sortable ------------------------------------------ */
        Sortable.create(existingGrid, {
            animation:   200,
            ghostClass:  'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass:   'sortable-drag',
            onEnd () {
                updateAllBadges();
                saveOrderAjax();
            }
        });

        /* -- Update number + Cover badges after each drag -------- */
        function updateAllBadges () {
            const cards = [...existingGrid.querySelectorAll('[data-photo-id]')];
            const ids   = [];

            cards.forEach((card, i) => {
                const id = card.dataset.photoId;
                ids.push(id);

                /* Number badge */
                const numBadge = card.querySelector('.photo-order-badge');
                if (numBadge) numBadge.textContent = i + 1;

                /* Cover label — show only on first, remove from rest */
                const badgeWrap = card.querySelector('.top-1\\.5.left-1\\.5');  // parent div
                let coverLbl = card.querySelector('.cover-label');
                if (i === 0) {
                    if (!coverLbl) {
                        coverLbl = document.createElement('span');
                        coverLbl.className = 'cover-label inline-flex items-center px-1.5 h-[22px] rounded text-[10px] font-bold bg-amber-500 text-white';
                        coverLbl.textContent = 'Cover';
                        card.querySelector('.photo-order-badge')?.insertAdjacentElement('afterend', coverLbl);
                    }
                } else {
                    coverLbl?.remove();
                }
            });

            photoOrderInput.value = JSON.stringify(ids);
        }
        
        function saveOrderAjax () {
            @if(isset($property))
            const ids = [...existingGrid.querySelectorAll('[data-photo-id]')]
                        .map(el => parseInt(el.dataset.photoId));
            fetch('{{ route("admin.properties.photos.reorder", $property ?? 0) }}', {
                method : 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body   : JSON.stringify({ order: ids }),
            });
            @endif
        }

        updateAllBadges();
        document.querySelectorAll('.photo-menu-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                document.querySelectorAll('.photo-menu-dropdown').forEach(d => {
                    if (d !== this.nextElementSibling) d.classList.add('hidden');
                });
                this.nextElementSibling.classList.toggle('hidden');
            });
        });

        document.addEventListener('click', () => {
            document.querySelectorAll('.photo-menu-dropdown').forEach(d => d.classList.add('hidden'));
        });

        document.querySelectorAll('.delete-existing-photo').forEach(btn => {
            btn.addEventListener('click', async function (e) {
                e.stopPropagation();
                if (!confirm('Hapus foto ini?')) return;

                const card = this.closest('[data-photo-id]');
                try {
                    const res = await fetch(this.dataset.deleteUrl, {
                        method : 'DELETE',
                        headers: { 'X-CSRF-TOKEN': csrfToken },
                    });
                    if (res.ok) {
                        card.remove();
                        updateAllBadges();
                    } else {
                        alert('Gagal menghapus foto.');
                    }
                } catch {
                    alert('Terjadi kesalahan jaringan.');
                }
            });
        });
    }

    /* ════════════════════════════════════════════════════════════
     * 2. NEW PHOTOS — preview grid dengan Sortable & nomor badge
     * ════════════════════════════════════════════════════════════ */
    let newFiles         = [];
    let newPhotosSortable = null;

    /** Activate Sortable on preview grid (called once) */
    function initNewSortable () {
        if (newPhotosSortable) return;
        newPhotosSortable = Sortable.create(previewGrid, {
            animation  : 200,
            ghostClass : 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass  : 'sortable-drag',
            onEnd () {
                syncNewFilesOrder();
                updateNewBadges();
            }
        });
    }

    /** Sync newFiles array to current DOM order after drag */
    function syncNewFilesOrder () {
        const ordered = [];
        previewGrid.querySelectorAll('[data-file-index]').forEach(el => {
            ordered.push(newFiles[parseInt(el.dataset.fileIndex)]);
        });
        newFiles = ordered;
        previewGrid.querySelectorAll('[data-file-index]').forEach((el, i) => {
            el.dataset.fileIndex = i;
        });
        rebuildFileInput();
    }

    /** Update number + Cover badges on new-photo previews */
    function updateNewBadges () {
        const cards = [...previewGrid.querySelectorAll('[data-file-index]')];
        cards.forEach((card, i) => {
            let numBadge = card.querySelector('.new-num-badge');
            if (numBadge) numBadge.textContent = i + 1;

            let coverLbl = card.querySelector('.new-cover-label');
            if (i === 0) {
                if (!coverLbl) {
                    coverLbl = document.createElement('span');
                    coverLbl.className   = 'new-cover-label inline-flex items-center px-1.5 h-[22px] rounded text-[10px] font-bold bg-amber-500 text-white pointer-events-none';
                    coverLbl.textContent = 'Cover';
                    numBadge?.insertAdjacentElement('afterend', coverLbl);
                }
            } else {
                coverLbl?.remove();
            }
        });
    }

    /** Sync file input with newFiles array */
    function rebuildFileInput () {
        const dt = new DataTransfer();
        newFiles.forEach(f => dt.items.add(f));
        photoInput.files = dt.files;
    }

    /** Add one file: render preview card with numbering */
    function addPreview (file) {
        const index  = newFiles.length;
        newFiles.push(file);

        const reader = new FileReader();
        reader.onload = ev => {
            const div = document.createElement('div');
            div.className      = 'relative rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 border-2 border-transparent hover:border-amber-400 transition-colors cursor-grab active:cursor-grabbing select-none';
            div.style.aspectRatio = '1';
            div.dataset.fileIndex = index;
            div.title           = 'Drag untuk ubah urutan';

            div.innerHTML = `
                <img src="${ev.target.result}"
                     class="w-full h-full object-cover pointer-events-none select-none"
                     draggable="false">

                <!-- bottom gradient -->
                <div class="absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>

                <!-- number + cover badge top-left -->
                <div class="absolute top-1.5 left-1.5 flex items-center gap-1">
                    <span class="new-num-badge inline-flex items-center justify-center min-w-[22px] h-[22px] px-1 rounded text-[11px] font-bold bg-black/60 text-white backdrop-blur-sm pointer-events-none">
                        ${index + 1}
                    </span>
                </div>

                <!-- ⊕ drag handle bottom-left -->
                <div class="absolute bottom-1.5 left-1.5 pointer-events-none">
                    <div class="w-7 h-7 rounded-full bg-black/50 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                </div>

                <!-- × delete bottom-right -->
                <button type="button"
                        class="remove-new-photo absolute bottom-1.5 right-1.5 w-7 h-7 rounded-full bg-red-500/80 hover:bg-red-500 text-white flex items-center justify-center transition-colors z-10">
                    <svg class="w-3.5 h-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;

            /* Delete handler */
            div.querySelector('.remove-new-photo').addEventListener('click', ev2 => {
                ev2.stopPropagation();
                const idx = parseInt(div.dataset.fileIndex);
                newFiles.splice(idx, 1);
                div.remove();
                // Re-index remaining
                previewGrid.querySelectorAll('[data-file-index]').forEach((el, i) => {
                    el.dataset.fileIndex = i;
                });
                rebuildFileInput();
                updateNewBadges();
            });

            previewGrid.appendChild(div);
            initNewSortable();
            updateNewBadges();
            rebuildFileInput();
        };
        reader.readAsDataURL(file);
    }

    /* ════════════════════════════════════════════════════════════
     * 3. PHOTO SELECTION MODAL (TAHAP 1)
     * ════════════════════════════════════════════════════════════ */
    let stagedFiles = [];
    let stagedSelection = []; // array of indices from stagedFiles
    let objectUrls = []; // store Object URLs for cleanup

    const modal         = document.getElementById('photo-selection-modal');
    const modalBackdrop = document.getElementById('photo-selection-backdrop');
    const modalContent  = document.getElementById('photo-selection-content');
    const modalGrid     = document.getElementById('staged-photos-grid');
    const btnCloseModal = document.getElementById('btn-close-modal');
    const cbSelectAll   = document.getElementById('checkbox-select-all');
    const btnConfirm    = document.getElementById('btn-confirm-photos');
    const btnConfirmTxt = document.getElementById('btn-confirm-text');
    const modalTitle    = document.getElementById('modal-title-count');

    function openModal(files) {
        // filter out files already in newFiles
        stagedFiles = files.filter(f => !newFiles.some(nf => nf.name === f.name && nf.size === f.size));
        if (stagedFiles.length === 0) return;

        // Pre-select all files by default
        stagedSelection = stagedFiles.map((_, i) => i);
        cbSelectAll.checked = true;
        
        buildModalGrid();
        updateModalVisuals();
        updateModalFooter();
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        // trigger animation
        setTimeout(() => {
            modalBackdrop.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
        
        // Reset photoInput so it doesn't accidentally submit if modal is cancelled
        photoInput.value = '';
    }

    function closeModal() {
        modalBackdrop.classList.add('opacity-0');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            stagedFiles = [];
            stagedSelection = [];
            modalGrid.innerHTML = '';
            
            // Cleanup object URLs to prevent memory leaks
            objectUrls.forEach(url => URL.revokeObjectURL(url));
            objectUrls = [];

            // restore input to match newFiles
            rebuildFileInput();
        }, 300);
    }

    btnCloseModal.addEventListener('click', closeModal);

    function buildModalGrid() {
        modalGrid.innerHTML = '';
        modalTitle.textContent = `Pilih Foto (${stagedFiles.length})`;
        objectUrls = [];

        stagedFiles.forEach((file, index) => {
            const url = URL.createObjectURL(file);
            objectUrls.push(url);
            
            const div = document.createElement('div');
            div.className = 'modal-photo-card relative rounded-xl overflow-hidden border-2 cursor-pointer transition-all select-none border-transparent hover:border-gray-300';
            div.style.aspectRatio = '1';
            div.dataset.stagedIndex = index;

            div.innerHTML = `
                <img src="${url}" class="w-full h-full object-cover pointer-events-none">
                
                <!-- Selection Indicator -->
                <div class="selection-indicator absolute top-2 right-2 w-6 h-6 rounded-full border-2 flex items-center justify-center text-xs font-bold transition-colors bg-black/20 border-white/70 backdrop-blur-sm">
                    <span class="selection-number"></span>
                </div>

                <div class="cover-badge absolute bottom-0 inset-x-0 bg-brand-500 text-white text-[10px] font-bold text-center py-1 uppercase tracking-wider hidden">Cover</div>
            `;

            div.addEventListener('click', () => {
                const selIdx = stagedSelection.indexOf(index);
                if (selIdx > -1) {
                    stagedSelection.splice(selIdx, 1);
                } else {
                    stagedSelection.push(index);
                }
                cbSelectAll.checked = stagedSelection.length === stagedFiles.length;
                updateModalVisuals();
                updateModalFooter();
            });

            modalGrid.appendChild(div);
        });
    }

    function updateModalVisuals() {
        modalGrid.querySelectorAll('.modal-photo-card').forEach(card => {
            const index = parseInt(card.dataset.stagedIndex);
            const isSelected = stagedSelection.includes(index);
            const orderNum = isSelected ? stagedSelection.indexOf(index) + 1 : '';
            
            const indicator = card.querySelector('.selection-indicator');
            const numSpan = card.querySelector('.selection-number');
            const coverBadge = card.querySelector('.cover-badge');

            numSpan.textContent = orderNum;

            if (isSelected) {
                card.classList.add('border-brand-500', 'shadow-md', 'transform', 'scale-[0.98]');
                card.classList.remove('border-transparent', 'hover:border-gray-300');
                
                indicator.classList.add('bg-brand-500', 'border-brand-500', 'text-white');
                indicator.classList.remove('bg-black/20', 'border-white/70', 'backdrop-blur-sm');
                
                if (orderNum === 1) coverBadge.classList.remove('hidden');
                else coverBadge.classList.add('hidden');
            } else {
                card.classList.remove('border-brand-500', 'shadow-md', 'transform', 'scale-[0.98]');
                card.classList.add('border-transparent', 'hover:border-gray-300');
                
                indicator.classList.remove('bg-brand-500', 'border-brand-500', 'text-white');
                indicator.classList.add('bg-black/20', 'border-white/70', 'backdrop-blur-sm');
                
                coverBadge.classList.add('hidden');
            }
        });
    }

    function updateModalFooter() {
        const count = stagedSelection.length;
        btnConfirmTxt.textContent = count > 0 ? `Gunakan Foto (${count})` : 'Gunakan Foto (0)';
        btnConfirm.disabled = count === 0;
    }

    cbSelectAll.addEventListener('change', (e) => {
        if (e.target.checked) {
            // Select all in current order
            stagedSelection = stagedFiles.map((_, i) => i);
        } else {
            // Deselect all
            stagedSelection = [];
        }
        updateModalVisuals();
        updateModalFooter();
    });

    btnConfirm.addEventListener('click', () => {
        if (stagedSelection.length === 0) return;
        
        // Convert selected staged files into newFiles via addPreview
        const filesToAdd = stagedSelection.map(idx => stagedFiles[idx]);
        
        // Hide modal immediately for UX
        closeModal();

        // Add them to the main grid
        filesToAdd.forEach(file => {
            addPreview(file);
        });
    });

    /* -- File input change -------------------------------------- */
    photoInput?.addEventListener('change', function () {
        if (this.files.length > 0) {
            openModal(Array.from(this.files));
        }
    });

    /* -- Drop zone --------------------------------------------- */
    const dropZone = document.getElementById('drop-zone');
    dropZone?.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.classList.add('border-amber-400', 'bg-amber-50', 'dark:bg-amber-900/10');
    });
    dropZone?.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-amber-400', 'bg-amber-50', 'dark:bg-amber-900/10');
    });
    dropZone?.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-amber-400', 'bg-amber-50', 'dark:bg-amber-900/10');
        const files = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/'));
        if (files.length > 0) {
            openModal(files);
        }
    });


    /* -- Hint text below new-photo grid ------------------------ */
    if (previewGrid) {
        const hint = document.createElement('p');
        hint.className   = 'text-[11px] text-gray-400 dark:text-gray-500 mt-1.5 hidden';
        hint.textContent = '⊕ Drag foto untuk ubah urutan — foto pertama menjadi Cover.';
        previewGrid.insertAdjacentElement('afterend', hint);
        new MutationObserver(() => {
            hint.classList.toggle('hidden', previewGrid.children.length === 0);
        }).observe(previewGrid, { childList: true });
    }

    /* -- Price Input Strict Validation (XXX,XX) ----------------- */
    const priceInput = document.getElementById('price_value');
    if (priceInput) {
        priceInput.addEventListener('input', function () {
            let val = this.value;

            // Only allow digits and comma
            val = val.replace(/[^0-9,]/g, '');

            // Only one comma allowed
            const parts = val.split(',');
            if (parts.length > 2) {
                val = parts[0] + ',' + parts.slice(1).join('');
            }

            // Max 3 digits before comma
            if (parts[0].length > 3) {
                parts[0] = parts[0].slice(0, 3);
            }

            // Max 2 digits after comma
            if (parts.length === 2 && parts[1].length > 2) {
                parts[1] = parts[1].slice(0, 2);
            }

            val = parts.length === 2 ? parts[0] + ',' + parts[1] : parts[0];
            this.value = val;
        });

        // Also block invalid key input early (before input event fires)
        priceInput.addEventListener('keydown', function (e) {
            const allowed = ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Home','End'];
            if (allowed.includes(e.key)) return;
            if (e.ctrlKey || e.metaKey) return; // allow copy/paste etc

            // Only allow digits and comma
            if (!/^[0-9,]$/.test(e.key)) {
                e.preventDefault();
                return;
            }

            const val = this.value;
            const selStart = this.selectionStart;
            const selEnd   = this.selectionEnd;
            const newVal   = val.slice(0, selStart) + e.key + val.slice(selEnd);
            const newParts = newVal.split(',');

            // Block if more than one comma
            if (e.key === ',' && val.includes(',')) {
                e.preventDefault();
                return;
            }
            // Block if digits before comma exceed 3
            if (newParts[0].length > 3) {
                e.preventDefault();
                return;
            }
            // Block if digits after comma exceed 2
            if (newParts.length === 2 && newParts[1].length > 2) {
                e.preventDefault();
                return;
            }
        });
    }

    /* -- Minus Plus Numeric Inputs ----------------------------- */
    document.querySelectorAll('.btn-increment').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            if (input) {
                input.value = parseInt(input.value || 0) + 1;
            }
        });
    });

    document.querySelectorAll('.btn-decrement').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            if (input) {
                const min = parseInt(this.dataset.min || 0);
                const current = parseInt(input.value || 0);
                if (current > min) {
                    input.value = current - 1;
                }
            }
        });
    });

    /* -- Disable hidden required inputs before submit ---------------- */
    const form = document.getElementById('property-form');
    if(form) {
        form.addEventListener('submit', function() {
            // AlpineJS sets display: none on hidden fields. 
            // We need to disable required attr on those so it doesn't block submission.
            const hiddenInputs = form.querySelectorAll('input:not([type="hidden"]), select, textarea');
            hiddenInputs.forEach(el => {
                if (el.offsetParent === null) {
                    el.removeAttribute('required');
                }
            });
        });
    }

    /* -- Condition Selector ------------------------------------ */
    const condBtns        = document.querySelectorAll('.cond-btn');
    const condInput       = document.getElementById('property_condition_input');

    const COND_ACTIVE = {
        'baru':      ['border-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/20', 'text-emerald-700', 'dark:text-emerald-400', 'shadow-md'],
        'second':    ['border-blue-500',    'bg-blue-50',    'dark:bg-blue-900/20',    'text-blue-700',    'dark:text-blue-400',    'shadow-md'],
        'aset-bank': ['border-purple-500',  'bg-purple-50',  'dark:bg-purple-900/20',  'text-purple-700',  'dark:text-purple-400',  'shadow-md'],
    };
    const COND_INACTIVE = ['border-gray-200', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800', 'text-gray-600', 'dark:text-gray-400'];

    condBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const cond = this.dataset.condition;
            condInput.value = cond;

            condBtns.forEach(b => {
                const bCond = b.dataset.condition;
                // Remove all possible active classes
                Object.values(COND_ACTIVE).flat().forEach(c => b.classList.remove(c));
                // Re-apply inactive
                COND_INACTIVE.forEach(c => b.classList.add(c));
            });

            // Apply this button's active state
            COND_INACTIVE.forEach(c => this.classList.remove(c));
            (COND_ACTIVE[cond] || []).forEach(c => this.classList.add(c));
        });
    });

    /* -- Location Autocomplete --------------------------------- */
    let DUMMY_LOCATIONS = [];
    
    // Fetch data lokasi dari address.json
    fetch('/address.json')
        .then(response => response.json())
        .then(data => {
            DUMMY_LOCATIONS = data;
        })
        .catch(error => console.error('Error fetching addresses:', error));

    const locInput = document.getElementById('location_autocomplete');
    const locClearBtn = document.getElementById('clear_location');
    const locSuggestDiv = document.getElementById('location_suggestions');
    const provInput = document.getElementById('province');
    const cityInput = document.getElementById('city');
    const districtInput = document.getElementById('district');

    function showSuggestions(query) {
        locSuggestDiv.innerHTML = '';
        if (!query) {
            locSuggestDiv.classList.add('hidden');
            locClearBtn.classList.add('hidden');
            return;
        }

        locClearBtn.classList.remove('hidden');
        const q = query.toLowerCase();
        const matches = DUMMY_LOCATIONS.filter(l => 
            l.label.toLowerCase().includes(q) || 
            l.city.toLowerCase().includes(q)
        );

        if (matches.length === 0) {
            locSuggestDiv.innerHTML = `<div class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Lokasi tidak ditemukan. Silakan isi manual di bawah.</div>`;
        } else {
            matches.forEach(m => {
                const item = document.createElement('div');
                item.className = 'px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer border-b border-gray-100 dark:border-gray-700/50 last:border-0 flex items-start gap-3';
                item.innerHTML = `
                    <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <div>
                        <div class="text-sm font-medium text-gray-900 dark:text-white">${m.label}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">${m.city}, ${m.province}</div>
                    </div>
                `;
                item.addEventListener('click', () => {
                    provInput.value = m.province;
                    cityInput.value = m.city;
                    districtInput.value = m.district;
                    locInput.value = `${m.label}, ${m.city}, ${m.province}`;
                    locSuggestDiv.classList.add('hidden');
                    
                    // Highlight fields to show they were updated
                    [provInput, cityInput, districtInput].forEach(inp => {
                        inp.classList.add('ring-2', 'ring-emerald-500');
                        setTimeout(() => inp.classList.remove('ring-2', 'ring-emerald-500'), 1000);
                    });
                });
                locSuggestDiv.appendChild(item);
            });
        }
        locSuggestDiv.classList.remove('hidden');
    }

    locInput.addEventListener('input', (e) => showSuggestions(e.target.value));
    locInput.addEventListener('focus', (e) => {
        if(e.target.value) showSuggestions(e.target.value);
    });

    locClearBtn.addEventListener('click', () => {
        locInput.value = '';
        locSuggestDiv.classList.add('hidden');
        locClearBtn.classList.add('hidden');
        locInput.focus();
    });

    // Close dropdown on click outside
    document.addEventListener('click', (e) => {
        if (!locInput.contains(e.target) && !locSuggestDiv.contains(e.target)) {
            locSuggestDiv.classList.add('hidden');
        }
    });

    // On edit mode, initialize autocomplete text
    if (provInput.value && cityInput.value && districtInput.value) {
        locInput.value = `${districtInput.value}, ${cityInput.value}, ${provInput.value}`;
        locClearBtn.classList.remove('hidden');
    }

    // Antisipasi submit tanpa foto setelah error validasi
    const propertyForm = document.getElementById('property-form');
    const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
    const isEdit = {{ isset($property) ? 'true' : 'false' }};
    const photoInputCheck = document.getElementById('photos');

    if (propertyForm && photoInputCheck) {
        propertyForm.addEventListener('submit', function(e) {
            // Hanya berlaku untuk form tambah baru (create)
            if (!isEdit && photoInputCheck.files.length === 0) {
                if (hasErrors) {
                    if (!confirm("⚠️ Peringatan: Anda belum memasukkan ulang foto setelah terjadi error. Data akan tersimpan tanpa foto.\n\nApakah Anda yakin ingin melanjutkan tanpa foto?")) {
                        e.preventDefault(); // Batalkan submit agar user bisa pilih foto
                        // Scroll ke area foto
                        document.getElementById('drop-zone').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    if (!confirm("Anda belum memilih foto satupun. Properti akan disimpan menggunakan foto default.\n\nLanjutkan menyimpan?")) {
                        e.preventDefault();
                        document.getElementById('drop-zone').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        });
    }
});
</script>

@endsection
