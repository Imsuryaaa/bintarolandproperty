<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoAdminController extends Controller
{
    /**
     * Menampilkan daftar promo.
     */
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('admin.promos.index', compact('promos'));
        // Note: Anda perlu membuat file view resources/views/admin/promos/index.blade.php
    }

    /**
     * Menyimpan data promo baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean'
        ]);

        $promo = new Promo();
        $promo->title = $validated['title'];
        $promo->description = $validated['description'] ?? null;
        $promo->link_url = $validated['link_url'] ?? null;
        $promo->is_active = $request->has('is_active');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('promos', 'public');
            $promo->image_path = $path;
        }

        // Jika promo ini diaktifkan, kita bisa menonaktifkan promo lain
        // agar hanya ada 1 promo aktif (opsional, tergantung kebutuhan bisnis)
        if ($promo->is_active) {
            Promo::where('id', '!=', $promo->id)->update(['is_active' => false]);
        }

        $promo->save();

        return redirect()->back()->with('success', 'Promo berhasil ditambahkan.');
    }

    /**
     * Toggle status aktif promo (Ajax / Form submit).
     */
    public function toggleStatus(Request $request, Promo $promo)
    {
        // Toggle the boolean value
        $promo->is_active = !$promo->is_active;
        $promo->save();

        // Jika promo ini diaktifkan, matikan yang lain
        if ($promo->is_active) {
            Promo::where('id', '!=', $promo->id)->update(['is_active' => false]);
        }

        return redirect()->back()->with('success', 'Status promo berhasil diubah.');
    }

    /**
     * Menghapus promo.
     */
    public function destroy(Promo $promo)
    {
        if ($promo->image_path && Storage::disk('public')->exists($promo->image_path)) {
            Storage::disk('public')->delete($promo->image_path);
        }
        $promo->delete();

        return redirect()->back()->with('success', 'Promo berhasil dihapus.');
    }
}
