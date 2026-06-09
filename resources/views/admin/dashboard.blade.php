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

<!-- Recent Properties — Custom Table -->
<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800" id="customTableRoot">

    {{-- Header: Title + Add Button --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-4 border-b border-gray-200 dark:border-gray-800">
        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Properti Terbaru</h2>
        <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 w-full sm:w-auto">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Properti
        </a>
    </div>

    {{-- Controls: Search + Per-page --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3 border-b border-gray-100 dark:border-gray-800/60">
        {{-- Per-page selector --}}
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <span>Tampilkan</span>
            <select id="ctPerPage" class="ct-select">
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="-1">Semua</option>
            </select>
            <span>baris</span>
        </div>
        {{-- Search --}}
        <div class="relative w-full sm:w-auto">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="ctSearch" placeholder="Cari properti..." class="ct-search-input">
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto" style="touch-action:pan-x pan-y;-webkit-overflow-scrolling:touch;">
        <table class="w-full text-sm min-w-[600px]">
            <thead>
                <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider min-w-[250px]">Nama Properti</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider min-w-[150px]">Lokasi</th>
                    <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="ctBody" class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach($recentProperties as $property)
                <tr class="ct-row hover:bg-amber-50/40 dark:hover:bg-amber-900/10 transition-colors duration-150"
                    data-search="{{ strtolower($property->title . ' ' . $property->full_location . ' ' . $property->formatted_price) }}">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <img src="{{ $property->image_url }}" alt="{{ $property->title }}"
                                 width="40" height="40" loading="lazy" decoding="async"
                                 class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-gray-200 dark:border-gray-700"
                                 onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=80&q=60'">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white text-sm">{{ Str::limit($property->title, 35) }}</p>
                                @if($property->is_featured)
                                    <span class="text-[10px] text-amber-600 dark:text-amber-400 font-medium">🔥 Hotsale</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 whitespace-nowrap text-gray-700 dark:text-gray-300 font-semibold">{{ $property->formatted_price }}</td>
                    <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 text-sm">
                        <span class="block truncate max-w-[200px]">{{ $property->full_location }}</span>
                    </td>
                    <td class="px-5 py-3.5 text-center whitespace-nowrap">
                        <a href="{{ route('admin.properties.edit', $property) }}" class="inline-flex p-1.5 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-100 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-900/40 transition-all shadow-sm" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Footer: Info + Pagination --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3 border-t border-gray-100 dark:border-gray-800">
        <p id="ctInfo" class="text-xs text-gray-500 dark:text-gray-400"></p>
        <div id="ctPagination" class="flex items-center flex-wrap gap-1"></div>
    </div>
</div>

{{-- Custom Table Styles --}}
<style>
    .ct-search-input {
        width: 100%;
        padding: 0.5rem 0.75rem 0.5rem 2.25rem;
        border: 1px solid #e5e7eb;
        border-radius: 9999px;
        background: #f9fafb;
        color: #111827;
        font-size: 0.8125rem;
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .ct-search-input:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
        background: #fff;
    }
    .dark .ct-search-input {
        background: #1f2937;
        border-color: #374151;
        color: #f3f4f6;
    }
    .dark .ct-search-input:focus {
        background: #111827;
        border-color: #f59e0b;
    }
    @media (min-width: 640px) {
        .ct-search-input { width: 240px; }
        .ct-search-input:focus { width: 300px; }
    }
    .ct-select {
        padding: 0.25rem 1.75rem 0.25rem 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        background: #f9fafb url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 0.35rem center / 0.875rem;
        appearance: none;
        font-size: 0.8125rem;
        color: #111827;
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .ct-select:focus { border-color: #f59e0b; }
    .dark .ct-select { background-color: #1f2937; border-color: #374151; color: #f3f4f6; }
    .ct-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        height: 2rem;
        padding: 0 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        background: #fff;
        cursor: pointer;
        transition: all 0.15s;
        user-select: none;
    }
    .ct-page-btn:hover:not(.active):not(.disabled) { background: #fffbeb; color: #d97706; border-color: #fcd34d; }
    .ct-page-btn.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }
    .ct-page-btn.disabled { opacity: 0.4; cursor: default; pointer-events: none; }
    .dark .ct-page-btn { background: #1f2937; border-color: #374151; color: #9ca3af; }
    .dark .ct-page-btn:hover:not(.active):not(.disabled) { background: #374151; color: #fcd34d; }
    .dark .ct-page-btn.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }
</style>

{{-- Custom Table Script (zero dependencies) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var allRows  = Array.from(document.querySelectorAll('#ctBody .ct-row'));
    var filtered = allRows.slice();
    var page     = 1;
    var perPage  = 10;

    var searchEl    = document.getElementById('ctSearch');
    var perPageEl   = document.getElementById('ctPerPage');
    var bodyEl      = document.getElementById('ctBody');
    var infoEl      = document.getElementById('ctInfo');
    var pagEl       = document.getElementById('ctPagination');

    function applyFilter() {
        var q = searchEl.value.trim().toLowerCase();
        filtered = q
            ? allRows.filter(function (r) { return r.dataset.search.indexOf(q) !== -1; })
            : allRows.slice();
        page = 1;
        render();
    }

    function render() {
        var total = filtered.length;
        var pp    = perPage < 0 ? total : perPage;
        var pages = Math.max(1, Math.ceil(total / pp));
        if (page > pages) page = pages;
        var start = (page - 1) * pp;
        var end   = perPage < 0 ? total : Math.min(start + pp, total);

        // hide all rows
        allRows.forEach(function (r) { r.style.display = 'none'; });
        // show filtered slice
        for (var i = start; i < end; i++) filtered[i].style.display = '';

        // info text
        infoEl.textContent = total === 0
            ? 'Tidak ada data'
            : 'Menampilkan ' + (start + 1) + '–' + end + ' dari ' + total + ' baris';

        // pagination
        pagEl.innerHTML = '';
        if (pages <= 1) return;

        addBtn('‹', page > 1 ? page - 1 : 0, page <= 1);
        for (var p = 1; p <= pages; p++) {
            if (pages > 7 && p > 2 && p < pages - 1 && Math.abs(p - page) > 1) {
                if (p === 3 || p === pages - 2) {
                    var dots = document.createElement('span');
                    dots.className = 'ct-page-btn disabled';
                    dots.textContent = '…';
                    pagEl.appendChild(dots);
                }
                continue;
            }
            addBtn(p, p, false, p === page);
        }
        addBtn('›', page < pages ? page + 1 : 0, page >= pages);
    }

    function addBtn(label, target, disabled, active) {
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'ct-page-btn' + (active ? ' active' : '') + (disabled ? ' disabled' : '');
        btn.textContent = label;
        if (target && !disabled) {
            btn.addEventListener('click', function () { page = target; render(); });
        }
        pagEl.appendChild(btn);
    }

    // Events
    searchEl.addEventListener('input', applyFilter);
    perPageEl.addEventListener('change', function () {
        perPage = parseInt(this.value);
        page = 1;
        render();
    });

    render();
});
</script>

@endsection

