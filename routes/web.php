<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserIsAdmin;
use App\Http\Middleware\VerifyCsrfTokenOverride;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::post('/stanice/1', [DataController::class, 'testEntry'])->withoutMiddleware(VerifyCsrfToken::class);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DataController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/database', [DataController::class, 'database'])->middleware([UserIsAdmin::class])->name('database');
Route::get('/graphs', [DataController::class, 'graphs']);
Route::get('/docs', [DataController::class, 'docs']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

