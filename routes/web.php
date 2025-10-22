<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;

// Ganti route lama dengan ini
Route::get('/', function () {
    // Langsung arahkan ke dashboard jika sudah login
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified']); // Lindungi dengan middleware auth

Route::get('/dashboard', function () {
    // Ambil data statistik
    $totalAssets = Asset::count();
    $assetsBaik = Asset::where('status', 'Baik')->count();
    $assetsPerbaikan = Asset::where('status', 'Perbaikan')->count();
    $assetsRusak = Asset::where('status', 'Rusak')->count();
    $totalCategories = Category::count();
    $totalLocations = Location::count();

    // Kirim semua data ke view 'dashboard'
    return view('dashboard', compact(
        'totalAssets',
        'assetsBaik',
        'assetsPerbaikan',
        'assetsRusak',
        'totalCategories',
        'totalLocations'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PASTIKAN 3 BARIS INI ADA DI DALAM GRUP
    Route::resource('assets', AssetController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('locations', LocationController::class);
});

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

Route::get('/test-admin', function () {
    // Cek dulu apakah ada user yang login
    if (!Auth::check()) {
        return 'Tidak ada user yang login.';
    }

    // Ambil data user yang sedang login
    $user = Auth::user();

    // Tampilkan semua data user, status Gate, dan perbandingannya
    dd([
        'Siapa yang login?' => $user->name . ' (' . $user->email . ')',
        'Apa isi role di database?' => $user->role,
        'Apakah $user->role == "admin" ?' => ($user->role == 'admin'),
        'Apakah Gate "is-admin" terbuka?' => Gate::allows('is-admin'),
    ]);

})->middleware('auth');

// ...

Route::get('/dashboard', function () {
    // Data lama (sudah ada)
    $totalAssets = Asset::count();
    $assetsBaik = Asset::where('status', 'Baik')->count();
    $assetsPerbaikan = Asset::where('status', 'Perbaikan')->count();
    $assetsRusak = Asset::where('status', 'Rusak')->count();
    $totalCategories = Category::count();
    $totalLocations = Location::count();

    // TAMBAHKAN INI: Data untuk chart kategori
    $chartKategori = Category::withCount('assets')->get();

    // Kirim semua data ke view 'dashboard'
    return view('dashboard', compact(
        'totalAssets',
        'assetsBaik',
        'assetsPerbaikan',
        'assetsRusak',
        'totalCategories',
        'totalLocations',
        'chartKategori' // <-- Kirim data chart
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
