@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
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
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-4 border-b border-gray-200 dark:border-gray-800">
        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Properti Terbaru</h2>
        <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 w-full sm:w-auto">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Properti
        </a>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 min-w-[250px]">Nama Properti</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 min-w-[150px]">Lokasi</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap">Aksi</th>
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
                    <td class="px-5 py-3.5 whitespace-nowrap text-gray-700 dark:text-gray-300 font-medium">{{ $property->formatted_price }}</td>
                    <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 text-sm truncate max-w-[200px]">{{ $property->full_location }}</td>
                    <td class="px-5 py-3.5 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.properties.edit', $property) }}" class="inline-flex p-1.5 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-100 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-900/40 transition-all shadow-sm" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
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
