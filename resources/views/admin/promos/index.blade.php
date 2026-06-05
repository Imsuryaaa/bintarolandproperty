@extends('layouts.admin')

@section('title', 'Manajemen Promo')
@section('page-title', 'Promo & Hot Sale')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

    <!-- Kolom Kiri: Form Tambah -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 sticky top-24">
            <h2 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Tambah Promo Baru</h2>
            
            <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <!-- Judul -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Promo *</label>
                    <input type="text" name="title" required class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-amber-500 focus:border-amber-500 p-2" placeholder="Cth: Promo Akhir Tahun">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-amber-500 focus:border-amber-500 p-2" placeholder="Cth: Dapatkan cashback 50 juta..."></textarea>
                </div>

                <!-- Link URL -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Link URL (Opsional)</label>
                    <input type="url" name="link_url" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-amber-500 focus:border-amber-500 p-2" placeholder="https://wa.me/...">
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Banner</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 dark:file:bg-amber-900/30 dark:file:text-amber-400">
                    <p class="text-[10px] text-gray-500 mt-1">Format: JPG, PNG, WEBP (Max 2MB). Ideal rasio 16:9 atau 1:1.</p>
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="rounded text-amber-600 focus:ring-amber-500 dark:bg-gray-800 dark:border-gray-700 h-4 w-4">
                    <label for="is_active" class="text-sm text-gray-700 dark:text-gray-300 font-medium">Jadikan Promo Aktif</label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm py-2 px-4 rounded-lg transition-colors">
                        Simpan Promo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Kolom Kanan: Daftar Promo -->
    <div class="w-full lg:w-2/3">
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800">
                <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Daftar Promo Tersimpan</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/20">
                            <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 w-16">Banner</th>
                            <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Informasi Promo</th>
                            <th class="text-center px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Status</th>
                            <th class="text-right px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($promos as $promo)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-5 py-3.5">
                                @if($promo->image_path)
                                    <img src="{{ Storage::url($promo->image_path) }}" alt="{{ $promo->title }}" class="w-12 h-12 rounded object-cover border border-gray-200 dark:border-gray-700">
                                @else
                                    <div class="w-12 h-12 rounded bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="font-bold text-gray-900 dark:text-white mb-0.5">{{ $promo->title }}</p>
                                @if($promo->description)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">{{ $promo->description }}</p>
                                @endif
                                <p class="text-[10px] text-gray-400 mt-1">Dibuat: {{ $promo->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                <form action="{{ route('admin.promos.toggle-status', $promo) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider transition-colors {{ $promo->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-400' }}">
                                        {{ $promo->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <form action="{{ route('admin.promos.destroy', $promo) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus promo ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors" title="Hapus Promo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 dark:bg-gray-800 mb-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                </div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white mb-1">Belum Ada Promo</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tambahkan promo pertama Anda melalui form di samping kiri.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($promos->hasPages())
                <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800">
                    {{ $promos->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
        
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <h3 class="text-xs font-bold text-blue-800 dark:text-blue-300 mb-1 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Informasi Penting
            </h3>
            <p class="text-xs text-blue-700 dark:text-blue-400 leading-relaxed">
                Hanya <strong>1 promo</strong> yang dapat aktif secara bersamaan di halaman utama. Jika Anda mengaktifkan sebuah promo, promo lain yang sebelumnya aktif akan otomatis dimatikan. Pengunjung website hanya akan melihat pop-up promo 1 kali per sesi (tidak muncul lagi saat mereka me-refresh halaman agar tidak mengganggu).
            </p>
        </div>
    </div>
</div>
@endsection
