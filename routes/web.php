<?php

use App\Http\Controllers\DataCollectionController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefundController;
use App\Http\Middleware\UserIsAdmin;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function () {
	$day = new Day();
//	$day->days('temperature', 2);
//	$day->dataLink('App\Models\DataTypes\Temperature');
	$week = $day->getTwoWeeks('temperature', '2025-01-10');
	@dd($week);
});

Route::post('/towers/{id}', [DataCollectionController::class, 'ingest'])->withoutMiddleware(VerifyCsrfToken::class)->name('ingest');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DataController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/reklamace/{id}', [RefundController::class, 'index'])->middleware(['auth', 'verified'])->name('refund');

Route::get('/database', [DataController::class, 'database'])->middleware([UserIsAdmin::class])->name('database');
Route::get('/graphs', [DataController::class, 'graphs']);
Route::get('/docs', [DataController::class, 'docs']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

