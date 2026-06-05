<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        // Ambil semua properti (slug + updated_at)
        $properties = Property::select('slug', 'updated_at')
            ->orderByDesc('updated_at')
            ->get();

        $content = view('sitemap', compact('properties'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
