<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KprPromo;
use Illuminate\Http\Request;

class KprPromoAdminController extends Controller
{
    /**
     * Menampilkan daftar promo KPR.
     */
    public function index()
    {
        $kprPromos = KprPromo::latest()->paginate(10);
        return view('admin.kpr-promos.index', compact('kprPromos'));
    }

    /**
     * Menyimpan data promo KPR baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bunga_fix' => 'required|numeric|min:0',
            'masa_fix' => 'required|integer|min:0',
            'bunga_floating' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $promo = new KprPromo();
        $promo->nama = $validated['nama'];
        $promo->bunga_fix = $validated['bunga_fix'];
        $promo->masa_fix = $validated['masa_fix'];
        $promo->bunga_floating = $validated['bunga_floating'];
        $promo->start_date = $validated['start_date'] ?? null;
        $promo->end_date = $validated['end_date'] ?? null;
        $promo->is_active = $request->has('is_active');
        $promo->save();

        return redirect()->back()->with('success', 'Promo KPR berhasil ditambahkan.');
    }

    /**
     * Toggle status aktif promo KPR.
     */
    public function toggleStatus(Request $request, KprPromo $kprPromo)
    {
        $kprPromo->is_active = !$kprPromo->is_active;
        $kprPromo->save();

        return redirect()->back()->with('success', 'Status promo KPR berhasil diubah.');
    }

    /**
     * Menghapus promo KPR.
     */
    public function destroy(KprPromo $kprPromo)
    {
        $kprPromo->delete();
        return redirect()->back()->with('success', 'Promo KPR berhasil dihapus.');
    }
}
