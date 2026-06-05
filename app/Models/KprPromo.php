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
    ];

    protected $casts = [
        'bunga_fix' => 'float',
        'masa_fix' => 'integer',
        'bunga_floating' => 'float',
        'is_active' => 'boolean',
    ];
}
