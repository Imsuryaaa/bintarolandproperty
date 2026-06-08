<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KprPromo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'bunga_fix',
        'masa_fix',
        'bunga_floating',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'bunga_fix' => 'float',
        'masa_fix' => 'integer',
        'bunga_floating' => 'float',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeActiveScheduled($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            });
    }
}
