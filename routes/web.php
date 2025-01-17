<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DataCollectionController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefundController;
use App\Http\Middleware\UserIsAdmin;
use App\Models\Day;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function () {

});


Route::get('/dashboard', [AppController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/reklamace/{id}', [RefundController::class, 'index'])->middleware(['auth', 'verified'])->name('refund');
Route::get('/tower/{tower_name}', [AppController::class, 'tower'])->middleware(['auth','verified']);

Route::get('/database', [DataController::class, 'database'])->middleware([UserIsAdmin::class])->name('database');
Route::get('/graphs', [DataController::class, 'graphs']);
Route::get('/docs', [DataController::class, 'docs']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/towers/{id}', [DataCollectionController::class, 'ingest'])->withoutMiddleware(VerifyCsrfToken::class)->name('ingest');

require __DIR__.'/auth.php';

