<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Property;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalProperties'  => Property::count(),
            'featuredCount'    => Property::where('is_featured', true)->count(),
            'totalCategories'  => Category::count(),
            'totalConditions'  => Condition::count(),
            'recentProperties' => Property::with(['categories'])->latest()->get(),
        ]);
    }
}
