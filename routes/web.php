<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PojokCeritaController;
use App\Http\Controllers\SastraTulisController;
use App\Http\Controllers\UserSastraSubmissionController;

Route::get('/', [HomeController::class,'index']);
Route::get('/tentang-jelita', [HomeController::class,'tentang']);
Route::get('/pojok-cerita', [PojokCeritaController::class,'index'])->name('pojok-cerita.index');
Route::get('/pojok-cerita/search', [PojokCeritaController::class,'search'])->name('pojok-cerita.search');
Route::get('/pojok-cerita/{id}', [PojokCeritaController::class,'showThumb'])
    ->whereNumber('id')
    ->name('pojok-cerita.thumb');
Route::get('/pojok-cerita/open-book/{id}', [PojokCeritaController::class,'showOpenBook'])
    ->whereNumber('id')
    ->name('pojok-cerita.open-book');
Route::post('/pojok-cerita/{id}/comments', [PojokCeritaController::class,'storeComment'])
    ->middleware('auth')
    ->name('pojok-cerita.comments.store');
Route::delete('/pojok-cerita/{id}/comments/{commentId}', [PojokCeritaController::class,'deleteComment'])
    ->middleware('auth')
    ->name('pojok-cerita.comments.delete');

// User submissions
Route::middleware('auth')->group(function () {
    Route::get('/pojok-cerita/submit', [UserSastraSubmissionController::class, 'create'])->name('pojok-cerita.submit.create');
    Route::post('/pojok-cerita/submit', [UserSastraSubmissionController::class, 'store'])->name('pojok-cerita.submit.store');
    Route::get('/pojok-cerita/my-works', [UserSastraSubmissionController::class, 'myWorks'])->name('pojok-cerita.my-works');
    Route::get('/pojok-cerita/my-works/{sastraTuli}/edit', [UserSastraSubmissionController::class, 'editMyWork'])->name('pojok-cerita.my-works.edit');
    Route::put('/pojok-cerita/my-works/{sastraTuli}', [UserSastraSubmissionController::class, 'updateMyWork'])->name('pojok-cerita.my-works.update');
    Route::delete('/pojok-cerita/my-works/{sastraTuli}', [UserSastraSubmissionController::class, 'deleteMyWork'])->name('pojok-cerita.my-works.delete');
});

// News routes
Route::get('/berita', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('admin')->middleware('auth','isAdmin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('sastra', SastraTulisController::class)->parameters(['sastra' => 'sastraTuli']);
    Route::patch('sastra/{sastraTuli}/approve', [SastraTulisController::class, 'approve'])->name('sastra.approve');
    Route::resource('news', NewsController::class)->names('admin.news');
    


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
