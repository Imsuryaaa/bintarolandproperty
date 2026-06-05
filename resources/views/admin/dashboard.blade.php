@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Properti</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalProperties }}</p>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Properti Hotsale</p>
        <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $featuredCount }}</p>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kategori</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalCategories }}</p>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kondisi</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalConditions }}</p>
    </div>
</div>

<!-- Recent Properties -->
<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-800">
        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Properti Terbaru</h2>
        <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors duration-200">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Properti
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Nama Properti</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 hidden md:table-cell">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 hidden lg:table-cell">Lokasi</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($recentProperties as $property)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <img src="{{ $property->image_url }}" alt="{{ $property->title }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0" onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=80&q=60'">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white text-sm">{{ Str::limit($property->title, 35) }}</p>
                                @if($property->is_featured)
                                    <span class="text-[10px] text-amber-600 dark:text-amber-400 font-medium">🔥 Hotsale</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden md:table-cell text-gray-700 dark:text-gray-300">{{ $property->formatted_price }}</td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-gray-500 dark:text-gray-400 text-sm">{{ $property->location ?? '-' }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.properties.edit', $property) }}" class="text-xs text-gray-600 dark:text-gray-400 hover:text-amber-600 dark:hover:text-amber-400 transition-colors">Edit</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-gray-400 text-sm">Belum ada properti</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($totalProperties > 5)
    <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800">
        <a href="{{ route('admin.properties.index') }}" class="text-xs text-amber-600 dark:text-amber-400 hover:underline font-medium">Lihat semua {{ $totalProperties }} properti →</a>
    </div>
    @endif
</div>

@endsection
