<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PojokCeritaController;
use App\Http\Controllers\SastraTulisController;

Route::get('/', [HomeController::class,'index']);
Route::get('/tentang-jelita', [HomeController::class,'tentang']);
Route::get('/pojok-cerita', [PojokCeritaController::class,'index'])->name('pojok-cerita.index');
Route::get('/pojok-cerita/{id}', [PojokCeritaController::class,'showThumb'])->name('pojok-cerita.thumb');
Route::get('/pojok-cerita/open-book/{id}', [PojokCeritaController::class,'showOpenBook'])->name('pojok-cerita.open-book');
Route::post('/pojok-cerita/{id}/comments', [PojokCeritaController::class,'storeComment'])
    ->middleware('auth')
    ->name('pojok-cerita.comments.store');

// News routes
Route::get('/berita', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('admin')->middleware('auth','isAdmin')->group(function() {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('sastra', SastraTulisController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class)->names('admin.news');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
