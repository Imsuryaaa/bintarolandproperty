<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_code',
        'property_type',
        'property_condition',
        'title',
        'slug',
        'price',
        'description',
        'bedrooms',
        'bathrooms',
        'floors',
        'garages',
        'carports',
        'land_area',
        'build_area',
        'province',
        'city',
        'district',
        'complex_name',
        'street_name',
        'is_featured',
    ];

    /**
     * Defines all property types and which spec fields are visible for each.
     * Keys: type slug, Values: array of active field names.
     */
    public const TYPES = [
        'rumah'       => ['label' => 'Rumah',       'icon' => '🏠', 'fields' => ['bedrooms','bathrooms','floors','garages','carports','land_area','build_area']],
        'apartemen'   => ['label' => 'Apartemen',   'icon' => '🏢', 'fields' => ['bedrooms','bathrooms','floors','build_area']],
        'tanah'       => ['label' => 'Tanah',       'icon' => '🌿', 'fields' => ['land_area']],
        'ruko'        => ['label' => 'Ruko',        'icon' => '🏪', 'fields' => ['floors','garages','land_area','build_area']],
        'kost'        => ['label' => 'Kost',        'icon' => '🛏️', 'fields' => ['bedrooms','bathrooms','floors','land_area','build_area']],
        'villa'       => ['label' => 'Villa',       'icon' => '🏡', 'fields' => ['bedrooms','bathrooms','floors','garages','carports','land_area','build_area']],
        'hotel'       => ['label' => 'Hotel',       'icon' => '🏨', 'fields' => ['floors','land_area','build_area']],
        'pabrik'      => ['label' => 'Pabrik',      'icon' => '🏭', 'fields' => ['floors','garages','land_area','build_area']],
        'gudang'      => ['label' => 'Gudang',      'icon' => '🏗️', 'fields' => ['floors','garages','land_area','build_area']],
        'perkantoran' => ['label' => 'Perkantoran', 'icon' => '🏛️', 'fields' => ['floors','land_area','build_area']],
        'ruang-usaha' => ['label' => 'Ruang Usaha', 'icon' => '🏬', 'fields' => ['floors','land_area','build_area']],
    ];

    /**
     * Available property conditions.
     */
    public const CONDITIONS = [
        'baru'       => ['label' => 'Baru',       'icon' => '✨', 'color' => 'emerald'],
        'second'     => ['label' => 'Second',     'icon' => '🔄', 'color' => 'blue'],
        'aset-bank'  => ['label' => 'Aset Bank',  'icon' => '🏦', 'color' => 'purple'],
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'land_area' => 'integer',
        'build_area' => 'integer',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The categories that belong to this property.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps();
    }

    /**
     * The conditions that belong to this property.
     */
    public function conditions(): BelongsToMany
    {
        return $this->belongsToMany(Condition::class)
            ->withTimestamps();
    }

    /**
     * The photos for this property, ordered by sort_order.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(PropertyPhoto::class)->orderBy('sort_order');
    }

    /**
     * Get formatted price attribute.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get formatted land area attribute.
     */
    public function getFormattedLandAreaAttribute(): string
    {
        return number_format($this->land_area, 0, ',', '.') . ' m²';
    }

    /**
     * Get formatted build area attribute.
     */
    public function getFormattedBuildAreaAttribute(): string
    {
        return number_format($this->build_area, 0, ',', '.') . ' m²';
    }

    /**
     * Get the primary (cover) image URL.
     * Priority: first uploaded photo → legacy image_path → placeholder
     */
    public function getImageUrlAttribute(): string
    {
        // Use first photo from multi-photo system if available
        if ($this->relationLoaded('photos') && $this->photos->isNotEmpty()) {
            return asset('images/properties/' . $this->photos->first()->file_path);
        }

        // Check the DB directly if relation not loaded
        $firstPhoto = $this->photos()->first();
        if ($firstPhoto) {
            return asset('images/properties/' . $firstPhoto->file_path);
        }

        // Generic placeholder
        return 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&q=80';
    }

    /**
     * Get the formatted location label (City, District).
     * Used for public display.
     */
    public function getLocationLabelAttribute(): string
    {
        $parts = [];
        if ($this->city) $parts[] = $this->city;
        if ($this->district) $parts[] = $this->district;
        
        return empty($parts) ? 'Lokasi tidak diketahui' : implode(', ', $parts);
    }

    /**
     * Get the full location with all details.
     * Used for admin dashboard display.
     */
    public function getFullLocationAttribute(): string
    {
        $parts = [];
        if ($this->street_name) $parts[] = $this->street_name;
        if ($this->complex_name) $parts[] = $this->complex_name;
        if ($this->district) $parts[] = $this->district;
        if ($this->city) $parts[] = $this->city;
        if ($this->province) $parts[] = $this->province;
        
        $parts = array_unique(array_filter($parts));
        
        return empty($parts) ? 'Lokasi tidak diisi' : implode(', ', $parts);
    }

    /**
     * Get WhatsApp share URL with pre-filled message.
     */
    public function getWhatsappUrlAttribute(): string
    {
        $phone = env('WHATSAPP_NUMBER', '6281234567890');
        $message = urlencode(
            "Halo, saya tertarik dengan properti dengan kode properti {$this->property_code}:\n" .
            "*{$this->title}*\n" .
            "Harga: {$this->formatted_price}\n" .
            "Lokasi: " . $this->location_label . "\n" .
            "Link: " . route('property.show', $this->slug)
        );
        
        return "https://wa.me/{$phone}?text={$message}";
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, string $categorySlug)
    {
        return $query->whereHas('categories', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Scope a query to filter by condition.
     */
    public function scopeByCondition($query, string $conditionSlug)
    {
        return $query->where('property_condition', $conditionSlug);
    }

    /**
     * Scope a query to only include featured properties.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to search by keyword.
     */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', "%{$keyword}%")
              ->orWhere('description', 'like', "%{$keyword}%")
              ->orWhere('city', 'like', "%{$keyword}%")
              ->orWhere('district', 'like', "%{$keyword}%")
              ->orWhere('complex_name', 'like', "%{$keyword}%")
              ->orWhere('street_name', 'like', "%{$keyword}%");
        });
    }
}
