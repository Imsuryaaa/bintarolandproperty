<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Property;
use App\Models\PropertyPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Spatie\Image\Image;

class PropertyAdminController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with(['categories', 'conditions', 'photos'])->latest()->get();

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
        // $conditions = Condition::orderBy('name')->get(); // Removed as per request to remove duplicate condition section

        return view('admin.properties.form', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        // 1. Normalize property code: uppercase + hapus semua spasi
        //    Contoh: "sp 001" → "SP001", "Spl0300" → "SPL0300"
        $normalizedCode = strtoupper(preg_replace('/\s+/', '', trim($request->property_code ?? '')));
        $request->merge(['property_code' => $normalizedCode]);

        // 2. Check duplicate — bandingkan secara case-insensitive & tanpa spasi
        $existing = Property::with('photos')
            ->whereRaw('UPPER(REPLACE(property_code, " ", "")) = ?', [$normalizedCode])
            ->first();
        if ($existing) {
            return back()->withInput()->with([
                'duplicate_error'    => true,
                'duplicate_property' => $existing
            ]);
        }

        // 3. Parse price (convert comma to dot, multiply by unit)
        $priceVal = (float) str_replace(',', '.', $request->price_value);
        $multiplier = 1;
        switch ($request->price_unit) {
            case 'Ribu': $multiplier = 1000; break;
            case 'Juta': $multiplier = 1000000; break;
            case 'Miliar': $multiplier = 1000000000; break;
            case 'Triliun': $multiplier = 1000000000000; break;
        }
        $request->merge(['price' => $priceVal * $multiplier]);

        $validated = $request->validate([
            'property_code'     => 'required|string|max:50',
            'property_type'     => 'required|string|in:' . implode(',', array_keys(\App\Models\Property::TYPES)),
            'listing_type'      => 'nullable|string|in:dijual,disewa',
            'rent_period'       => 'nullable|string|in:tahun,bulan,hari',
            'price_type'        => 'nullable|string|in:total,per_m2',
            'property_condition'=> 'required|string|in:' . implode(',', array_keys(\App\Models\Property::CONDITIONS)),
            'title'             => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'bedrooms'     => 'nullable|integer|min:0',
            'bathrooms'    => 'nullable|integer|min:0',
            'floors'       => 'nullable|integer|min:1',
            'garages'      => 'nullable|integer|min:0',
            'carports'     => 'nullable|integer|min:0',
            'land_area'    => 'nullable|integer|min:0',
            'build_area'   => 'nullable|integer|min:0',
            'province'     => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'district'     => 'required|string|max:255',
            'complex_name' => 'nullable|string|max:255',
            'street_name'  => 'nullable|string|max:255',
            'is_featured'  => 'nullable|boolean',
            'photos'       => 'nullable|array|max:20',
            'photos.*'     => 'image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'category_id'  => 'required|exists:categories,id',
        ]);

        $property = Property::create([
            'property_code'      => $normalizedCode,
            'property_type'      => $validated['property_type'],
            'listing_type'       => $validated['listing_type'] ?? 'dijual',
            'rent_period'        => $validated['listing_type'] === 'disewa' ? ($validated['rent_period'] ?? 'tahun') : null,
            'price_type'         => in_array($validated['property_type'], ['tanah', 'ruko']) ? ($validated['price_type'] ?? 'total') : 'total',
            'property_condition' => $validated['property_condition'],
            'title'              => $validated['title'],
            'slug'               => $this->generateUniqueSlug($validated['title']),
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'bedrooms'    => $validated['bedrooms'] ?? 0,
            'bathrooms'   => $validated['bathrooms'] ?? 0,
            'floors'      => $validated['floors'] ?? 1,
            'garages'     => $validated['garages'] ?? 0,
            'carports'    => $validated['carports'] ?? 0,
            'land_area'   => $validated['land_area'] ?? 0,
            'build_area'  => $validated['build_area'] ?? 0,
            'province'    => $validated['province'],
            'city'        => $validated['city'],
            'district'    => $validated['district'],
            'complex_name'=> $validated['complex_name'] ?? null,
            'street_name' => $validated['street_name'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        // Save multiple photos
        if ($request->hasFile('photos')) {
            $this->storePhotos($property, $request->file('photos'));
        }

        if (!empty($validated['category_id'])) {
            $property->categories()->sync([$validated['category_id']]);
        }

        return redirect()->route('admin.properties.index')
            ->with('success', 'Properti berhasil ditambahkan.');
    }

    public function edit(Property $property)
    {
        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
        $property->load(['categories', 'photos']);

        return view('admin.properties.form', compact('property', 'parentCategories'));
    }

    public function update(Request $request, Property $property)
    {
        // 1. Normalize property code: uppercase + hapus semua spasi
        $normalizedCode = strtoupper(preg_replace('/\s+/', '', trim($request->property_code ?? '')));
        $request->merge(['property_code' => $normalizedCode]);

        // 2. Check duplicate — case-insensitive & tanpa spasi, kecuali diri sendiri
        $existing = Property::with('photos')
            ->whereRaw('UPPER(REPLACE(property_code, " ", "")) = ?', [$normalizedCode])
            ->where('id', '!=', $property->id)
            ->first();
        if ($existing) {
            return back()->withInput()->with([
                'duplicate_error'    => true,
                'duplicate_property' => $existing
            ]);
        }

        // 2. Parse price (convert comma to dot, multiply by unit)
        $priceVal = (float) str_replace(',', '.', $request->price_value);
        $multiplier = 1;
        switch ($request->price_unit) {
            case 'Ribu': $multiplier = 1000; break;
            case 'Juta': $multiplier = 1000000; break;
            case 'Miliar': $multiplier = 1000000000; break;
            case 'Triliun': $multiplier = 1000000000000; break;
        }
        $request->merge(['price' => $priceVal * $multiplier]);

        $validated = $request->validate([
            'property_code'     => 'required|string|max:50',
            'property_type'     => 'required|string|in:' . implode(',', array_keys(\App\Models\Property::TYPES)),
            'listing_type'      => 'nullable|string|in:dijual,disewa',
            'rent_period'       => 'nullable|string|in:tahun,bulan,hari',
            'price_type'        => 'nullable|string|in:total,per_m2',
            'property_condition'=> 'required|string|in:' . implode(',', array_keys(\App\Models\Property::CONDITIONS)),
            'title'             => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'bedrooms'     => 'nullable|integer|min:0',
            'bathrooms'    => 'nullable|integer|min:0',
            'floors'       => 'nullable|integer|min:1',
            'garages'      => 'nullable|integer|min:0',
            'carports'     => 'nullable|integer|min:0',
            'land_area'    => 'nullable|integer|min:0',
            'build_area'   => 'nullable|integer|min:0',
            'province'     => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'district'     => 'required|string|max:255',
            'complex_name' => 'nullable|string|max:255',
            'street_name'  => 'nullable|string|max:255',
            'is_featured'  => 'nullable|boolean',
            'photos'       => 'nullable|array|max:20',
            'photos.*'     => 'image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'exists:property_photos,id',
            'photo_order'  => 'nullable|string',   // JSON: "[1,3,2]"
            'category_id'  => 'required|exists:categories,id',
        ]);

        // Delete individually-removed photos
        if (!empty($validated['delete_photos'])) {
            $toDelete = PropertyPhoto::whereIn('id', $validated['delete_photos'])
                ->where('property_id', $property->id)
                ->get();
            foreach ($toDelete as $photo) {
                $this->deletePhotoFile($photo->file_path);
                $photo->delete();
            }
        }

        // Add new uploaded photos
        if ($request->hasFile('photos')) {
            $existingCount = $property->photos()->count();
            $this->storePhotos($property, $request->file('photos'), $existingCount);
        }

        // Re-apply sort order from drag-and-drop
        if (!empty($validated['photo_order'])) {
            $order = json_decode($validated['photo_order'], true);
            if (is_array($order)) {
                foreach ($order as $position => $photoId) {
                    PropertyPhoto::where('id', $photoId)
                        ->where('property_id', $property->id)
                        ->update(['sort_order' => $position]);
                }
            }
        }

        // Check if property_code changed, rename folder if necessary (optional but good practice)
        if ($property->property_code !== $validated['property_code']) {
            $oldDir = public_path('images/properties/' . $property->property_code);
            $newDir = public_path('images/properties/' . $validated['property_code']);
            if (is_dir($oldDir) && !is_dir($newDir)) {
                rename($oldDir, $newDir);
                // Also update DB file paths
                foreach ($property->photos as $photo) {
                    $newPath = str_replace($property->property_code . '/', $validated['property_code'] . '/', $photo->file_path);
                    $photo->update(['file_path' => $newPath]);
                }
            }
        }

        $slug = $property->title !== $validated['title']
            ? $this->generateUniqueSlug($validated['title'], $property->id)
            : $property->slug;

        $property->update([
            'property_code'      => $normalizedCode,
            'property_type'      => $validated['property_type'],
            'listing_type'       => $validated['listing_type'] ?? 'dijual',
            'rent_period'        => $validated['listing_type'] === 'disewa' ? ($validated['rent_period'] ?? 'tahun') : null,
            'price_type'         => in_array($validated['property_type'], ['tanah', 'ruko']) ? ($validated['price_type'] ?? 'total') : 'total',
            'property_condition' => $validated['property_condition'],
            'title'              => $validated['title'],
            'slug'        => $slug,
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'bedrooms'    => $validated['bedrooms'] ?? 0,
            'bathrooms'   => $validated['bathrooms'] ?? 0,
            'floors'      => $validated['floors'] ?? 1,
            'garages'     => $validated['garages'] ?? 0,
            'carports'    => $validated['carports'] ?? 0,
            'land_area'   => $validated['land_area'] ?? 0,
            'build_area'  => $validated['build_area'] ?? 0,
            'province'    => $validated['province'],
            'city'        => $validated['city'],
            'district'    => $validated['district'],
            'complex_name'=> $validated['complex_name'] ?? null,
            'street_name' => $validated['street_name'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        $property->categories()->sync([$validated['category_id']]);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Properti berhasil diperbarui.');
    }

    /**
     * Reorder photos via AJAX.
     */
    public function reorderPhotos(Request $request, Property $property): JsonResponse
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:property_photos,id',
        ]);

        foreach ($request->order as $position => $photoId) {
            PropertyPhoto::where('id', $photoId)
                ->where('property_id', $property->id)
                ->update(['sort_order' => $position]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Delete a single photo via AJAX.
     */
    public function destroyPhoto(Property $property, PropertyPhoto $photo): JsonResponse
    {
        if ($photo->property_id !== $property->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->deletePhotoFile($photo->file_path);
        $photo->delete();

        return response()->json(['success' => true]);
    }

    public function destroy(Property $property)
    {
        $dirPath = public_path('images/properties/' . $property->property_code);
        if (File::exists($dirPath)) {
            File::deleteDirectory($dirPath);
        }
        
        $property->photos()->delete();

        $property->categories()->detach();
        $property->conditions()->detach();
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Properti berhasil dihapus.');
    }

    /* ─── Helpers ─────────────────────────────────────────────── */

    /**
     * Simpan foto properti dengan konversi ke WebP.
     *
     * Hierarki driver:
     * 1. Spatie Image (Imagick atau GD — auto-detect)
     *    → Lebih akurat, handle EXIF, color profile, dan resize berkualitas tinggi.
     * 2. GD native fallback — jika Spatie tidak tersedia.
     * 3. File original — last resort.
     */
    private function savePhoto($file, string $propertyCode): string
    {
        $directory = public_path('images/properties/' . $propertyCode);

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $uuid     = (string) Str::uuid();
        $filename = $uuid . '.webp';
        $destPath = $directory . '/' . $filename;

        // ── Driver 1: Spatie Image ─────────────────────────────────────────────
        // Spatie Image v3 menggunakan GD atau Imagick secara otomatis.
        // Lebih unggul dari GD raw: handle EXIF orientasi, ICC profile,
        // dan kualitas resize (Lanczos resampling via Imagick jika tersedia).
        if (class_exists('\\Spatie\\Image\\Image')) {
            try {
                Image::load($file->getRealPath())
                    ->width(1600)       // Auto-resize: maks 1600px lebar, height proporsional
                    ->quality(82)       // WebP quality 82 — sweet spot kualitas vs ukuran
                    ->save($destPath);  // Spatie auto-detect format WebP dari ekstensi .webp

                return $propertyCode . '/' . $filename;
            } catch (\Throwable $e) {
                // Spatie gagal → coba GD fallback di bawah
                // (file mungkin partial, hapus dulu jika ada)
                if (File::exists($destPath)) {
                    File::delete($destPath);
                }
            }
        }

        // ── Driver 2: GD native ────────────────────────────────────────────────
        // Dipakai jika Spatie tidak tersedia atau gagal.
        if (function_exists('imagewebp') && function_exists('imagecreatefromstring')) {
            try {
                $rawData  = file_get_contents($file->getRealPath());
                $srcImage = @imagecreatefromstring($rawData);

                if ($srcImage !== false) {
                    // Koreksi orientasi EXIF (penting untuk foto dari HP)
                    $mime = $file->getMimeType();
                    if (in_array($mime, ['image/jpeg', 'image/jpg']) && function_exists('exif_read_data')) {
                        $exif = @exif_read_data($file->getRealPath());
                        if (!empty($exif['Orientation'])) {
                            switch ($exif['Orientation']) {
                                case 3: $srcImage = imagerotate($srcImage, 180, 0); break;
                                case 6: $srcImage = imagerotate($srcImage, -90, 0); break;
                                case 8: $srcImage = imagerotate($srcImage, 90, 0);  break;
                            }
                        }
                    }

                    // Auto-resize: maks 1600px lebar
                    $origW = imagesx($srcImage);
                    $origH = imagesy($srcImage);
                    $maxW  = 1600;

                    if ($origW > $maxW) {
                        $newW    = $maxW;
                        $newH    = (int) round($origH * ($maxW / $origW));
                        $resized = imagecreatetruecolor($newW, $newH);

                        imagealphablending($resized, false);
                        imagesavealpha($resized, true);
                        $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                        imagefilledrectangle($resized, 0, 0, $newW, $newH, $transparent);
                        imagealphablending($resized, true);

                        imagecopyresampled($resized, $srcImage, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                        imagedestroy($srcImage);
                        $srcImage = $resized;
                    }

                    imagewebp($srcImage, $destPath, 82);
                    imagedestroy($srcImage);

                    return $propertyCode . '/' . $filename;
                }
            } catch (\Throwable $e) {
                // Fall through ke simpan original
            }
        }

        // ── Driver 3: Simpan file original ────────────────────────────────────
        $origFilename = $uuid . '.' . $file->extension();
        $file->move($directory, $origFilename);
        return $propertyCode . '/' . $origFilename;
    }

    private function storePhotos(Property $property, array $files, int $startOrder = 0): void
    {
        foreach ($files as $i => $file) {
            $filename = $this->savePhoto($file, $property->property_code);
            PropertyPhoto::create([
                'property_id' => $property->id,
                'file_path'   => $filename,
                'sort_order'  => $startOrder + $i,
            ]);
        }
    }

    private function deletePhotoFile(string $filePath): void
    {
        $fullPath = public_path('images/properties/' . $filePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Property::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
