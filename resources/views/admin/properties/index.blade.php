@extends('layouts.admin')

@section('title', 'Kelola Properti')
@section('page-title', 'Kelola Properti')

@section('content')

@section('head')
<style>
/* DataTables Overrides to match Dashboard Theme */
div.dt-container { font-size: 0.875rem; color: inherit; }
div.dt-container .dt-search input, div.dt-container .dt-length select {
    border-radius: 0.5rem; border: 1px solid #d1d5db; padding: 0.375rem 0.75rem; background-color: transparent; transition: all 0.2s;
}
.dark div.dt-container .dt-search input, .dark div.dt-container .dt-length select {
    border-color: #374151; color: #f9fafb;
}
.dark div.dt-container .dt-length select { background-color: #111827; }
div.dt-container .dt-search input:focus, div.dt-container .dt-length select:focus {
    border-color: #f59e0b; outline: none; box-shadow: 0 0 0 1px #f59e0b;
}
div.dt-container .dt-paging .dt-paging-button {
    padding: 0.25rem 0.75rem; margin-left: 0.25rem; border-radius: 0.375rem; color: #4b5563; border: 1px solid transparent; transition: all 0.2s;
}
.dark div.dt-container .dt-paging .dt-paging-button { color: #d1d5db; }
div.dt-container .dt-paging .dt-paging-button:hover:not(.disabled) { background-color: #f3f4f6; border-color: #e5e7eb; }
.dark div.dt-container .dt-paging .dt-paging-button:hover:not(.disabled) { background-color: #374151; border-color: #4b5563; color: white; }
div.dt-container .dt-paging .dt-paging-button.current, div.dt-container .dt-paging .dt-paging-button.current:hover {
    background-color: #f59e0b !important; color: white !important; border-color: #f59e0b !important;
}
div.dt-container .dt-info, div.dt-container .dt-length label, div.dt-container .dt-search label { color: #6b7280; font-weight: 500; }
.dark div.dt-container .dt-info, .dark div.dt-container .dt-length label, .dark div.dt-container .dt-search label { color: #9ca3af; }
table.dataTable thead th, table.dataTable thead td { border-bottom: 1px solid #e5e7eb !important; }
.dark table.dataTable thead th, .dark table.dataTable thead td { border-bottom: 1px solid #374151 !important; }
table.dataTable.no-footer { border-bottom: 1px solid #e5e7eb !important; }
.dark table.dataTable.no-footer { border-bottom: 1px solid #374151 !important; }
div.dt-container .dt-layout-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
div.dt-container .dt-layout-row:last-child { margin-top: 1rem; margin-bottom: 0; }
@media (max-width: 640px) { div.dt-container .dt-layout-row { flex-direction: column; gap: 1rem; align-items: stretch; text-align: center; } }
</style>
@endsection

<div class="flex flex-col md:flex-row md:items-center justify-end gap-4 mb-6">
    <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 whitespace-nowrap w-full sm:w-auto">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Properti
    </a>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 shadow-sm">
    <div class="overflow-x-auto">
        <table id="propertiesTable" class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Kode Agen</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Properti</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 hidden sm:table-cell">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 hidden md:table-cell">Spesifikasi</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 hidden lg:table-cell">Kategori</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Status</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($properties as $property)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 group">
                    <td class="px-5 py-4">
                        <span class="inline-block px-2 py-1 text-xs font-bold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 rounded">{{ $property->property_code }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $property->image_url }}" alt="{{ $property->title }}"
                                 class="w-12 h-12 rounded-lg object-cover flex-shrink-0 border border-gray-200 dark:border-gray-700"
                                 onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=80&q=60'">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ Str::limit($property->title, 40) }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $property->location ?? 'Lokasi tidak diisi' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 hidden sm:table-cell">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ $property->formatted_price }}</span>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell text-gray-500 dark:text-gray-400 text-xs space-y-0.5">
                        <div>{{ $property->bedrooms }} KT · {{ $property->bathrooms }} KM</div>
                        <div>LT {{ $property->formatted_land_area }}</div>
                    </td>
                    <td class="px-5 py-4 hidden lg:table-cell">
                        <div class="flex flex-wrap gap-1">
                            @foreach($property->categories as $cat)
                                <span class="inline-block px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-md">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        @if($property->is_featured)
                            <span class="inline-block px-2 py-0.5 text-xs bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-md font-medium">Hotsale</span>
                        @else
                            <span class="inline-block px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-500 rounded-md">Biasa</span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('property.show', $property) }}" target="_blank"
                               class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all"
                               title="Lihat di website">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.properties.edit', $property) }}"
                               class="p-1.5 rounded-md text-gray-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.properties.destroy', $property) }}" onsubmit="return confirm('Hapus properti ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-md text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-16 text-center">
                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <p class="text-gray-400 text-sm">Belum ada properti</p>
                        <a href="{{ route('admin.properties.create') }}" class="mt-3 inline-block text-sm text-amber-600 hover:underline">Tambah properti pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script type="module">
document.addEventListener('DOMContentLoaded', function () {
    if (window.$ && window.DataTable) {
        $('#propertiesTable').DataTable({
            responsive: true,
            language: {
                search: "",
                searchPlaceholder: "Cari data properti...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ properti",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(disaring dari _MAX_ total data)",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                { orderable: false, targets: 5 } // Matikan sorting untuk kolom Aksi
            ]
        });
    }
});
</script>
@endsection
