<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ListingController::class, 'index'])->name('listings.index');
Route::get('/listing-create', [\App\Http\Controllers\ListingController::class, 'create'])->name('listings.create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
