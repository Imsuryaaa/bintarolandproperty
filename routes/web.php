<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PropertyAdminController;
use App\Http\Middleware\AdminAuthenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage with property listings and filters
Route::get('/', [PropertyController::class, 'index'])
    ->name('home');

// All properties listing page
Route::get('/properti', [PropertyController::class, 'allProperties'])
    ->name('properties.all');

// Hotsale properties listing page
Route::get('/hotsale', [PropertyController::class, 'hotsaleProperties'])
    ->name('properties.hotsale');


// Sitemap XML (for Google Search Console & SEO)
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])
    ->name('sitemap');

// Robots.txt
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin/\n\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
})->name('robots');


// Property detail page - uses Route Model Binding
Route::get('/properti/{property:slug}', [PropertyController::class, 'show'])
    ->name('property.show');

// Filter by category - uses Route Model Binding
Route::get('/kategori/{category:slug}', [PropertyController::class, 'byCategory'])
    ->name('category.show');

// Grouped properties by Area
Route::get('/area/{area}', [PropertyController::class, 'area'])
    ->name('area.show');

// Search route (POST for form submission, redirects to GET)
Route::post('/cari', function (\Illuminate\Http\Request $request) {
    return redirect()->route('home', $request->only([
        'search', 'category', 'condition', 'min_price', 'max_price', 'sort'
    ]));
})->name('search');

// KPR Simulation
Route::get('/simulasi-kpr', function () {
    $defaultRate = env('KPR_DEFAULT_RATE', 5);
    $kprPromos = \App\Models\KprPromo::where('is_active', true)->get();
    return view('kpr.simulasi', compact('defaultRate', 'kprPromos'));
})->name('simulasi-kpr');

// Tentang Kami
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Admin: Login (public — no auth needed)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(AdminAuthenticate::class)->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('properties', PropertyAdminController::class)->except(['show']);

        // Multi-photo management (AJAX)
        Route::delete('properties/{property}/photos/{photo}', [PropertyAdminController::class, 'destroyPhoto'])
            ->name('properties.photos.destroy');
        Route::post('properties/{property}/photos/reorder', [PropertyAdminController::class, 'reorderPhotos'])
            ->name('properties.photos.reorder');

        // Promo management
        Route::resource('promos', \App\Http\Controllers\Admin\PromoAdminController::class)->only(['index', 'store', 'destroy']);
        Route::post('promos/{promo}/toggle-status', [\App\Http\Controllers\Admin\PromoAdminController::class, 'toggleStatus'])
            ->name('promos.toggle-status');

        // KPR Promo management
        Route::resource('kpr-promos', \App\Http\Controllers\Admin\KprPromoAdminController::class)->only(['index', 'store', 'destroy']);
        Route::post('kpr-promos/{kpr_promo}/toggle-status', [\App\Http\Controllers\Admin\KprPromoAdminController::class, 'toggleStatus'])
            ->name('kpr-promos.toggle-status');

        // Admin User management (Super Admin Only)
        Route::middleware(\App\Http\Middleware\SuperAdminAuthenticate::class)->group(function () {
            Route::resource('admins', \App\Http\Controllers\Admin\AdminUserController::class)->except(['show']);
            Route::post('admins/{admin}/toggle-status', [\App\Http\Controllers\Admin\AdminUserController::class, 'toggleStatus'])
                ->name('admins.toggle-status');
        });
    });
});
