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
        // 1. Check duplicate property code
        $existing = Property::with('photos')->where('property_code', $request->property_code)->first();
        if ($existing) {
            return back()->withInput()->with([
                'duplicate_error' => true,
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
            'property_code'     => 'required|string|max:50|unique:properties,property_code',
            'property_type'     => 'required|string|in:' . implode(',', array_keys(\App\Models\Property::TYPES)),
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
            'photos.*'     => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'category_id'  => 'required|exists:categories,id',
        ]);

        $property = Property::create([
            'property_code'      => $validated['property_code'],
            'property_type'      => $validated['property_type'],
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
        // 1. Check duplicate property code
        $existing = Property::with('photos')->where('property_code', $request->property_code)->first();
        if ($existing && $existing->id !== $property->id) {
            return back()->withInput()->with([
                'duplicate_error' => true,
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
            'property_code'     => 'required|string|max:50|unique:properties,property_code,' . $property->id,
            'property_type'     => 'required|string|in:' . implode(',', array_keys(\App\Models\Property::TYPES)),
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
            'photos.*'     => 'image|mimes:jpg,jpeg,png,webp,gif|max:5120',
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
            'property_code'      => $validated['property_code'],
            'property_type'      => $validated['property_type'],
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

    private function savePhoto($file, string $propertyCode): string
    {
        $directory = public_path('images/properties/' . $propertyCode);

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $uuid = (string) Str::uuid();

        // ── Attempt WebP conversion via GD ───────────────────────────
        if (function_exists('imagewebp') && function_exists('imagecreatefromstring')) {
            try {
                $rawData = file_get_contents($file->getRealPath());
                $srcImage = @imagecreatefromstring($rawData);

                if ($srcImage !== false) {
                    $filename = $uuid . '.webp';
                    $destPath = $directory . '/' . $filename;

                    // Preserve transparency for PNG/GIF
                    if (imageistruecolor($srcImage)) {
                        imagealphablending($srcImage, true);
                        imagesavealpha($srcImage, true);
                    }

                    // Convert & save as WebP at 80% quality
                    imagewebp($srcImage, $destPath, 80);
                    imagedestroy($srcImage);

                    return $propertyCode . '/' . $filename;
                }
            } catch (\Throwable $e) {
                // Fall through to original save below
            }
        }

        // ── Fallback: save original file if GD not available ─────────
        $filename = $uuid . '.' . $file->extension();
        $file->move($directory, $filename);
        return $propertyCode . '/' . $filename;
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
