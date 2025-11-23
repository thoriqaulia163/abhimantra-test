<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SekolahController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/products',[ProductController::Class, 'index'])->name('products.index');
    Route::get('/products/create',[ProductController::Class, 'create'])->name('products.create');
    Route::post('/products',[ProductController::Class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit',[ProductController::Class, 'edit'])->name('products.edit');
    Route::put('/products/{product}',[ProductController::Class, 'update'])->name('products.update');
    Route::delete('/products/{product}',[ProductController::Class, 'destroy'])->name('products.delete');

    Route::get('/daftar-nilai',[SekolahController::Class, 'index'])->name('nilai.index');
    Route::get('/daftar-nilai/create',[SekolahController::Class, 'create'])->name('nilai.create');
    Route::get('/daftar-nilai/create-siswa',[SekolahController::Class, 'createsiswa'])->name('siswa.create');
    Route::post('/daftar-nilai',[SekolahController::Class, 'store'])->name('nilai.store');
    Route::post('/daftar-nilai-siswa',[SekolahController::Class, 'storesiswa'])->name('siswa.store');
     Route::get('/daftar-nilai/{nilai}/edit',[SekolahController::Class, 'edit'])->name('nilai.edit');
    Route::put('/daftar-nilai/{nilai}',[SekolahController::Class, 'update'])->name('nilai.update');
    Route::delete('/daftar-nilai/{nilai}',[SekolahController::Class, 'destroy'])->name('nilai.delete');
});

require __DIR__.'/settings.php';
