<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DataCollectionController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\TowerController;
use App\Http\Middleware\UserIsAdmin;
use App\Models\Day;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function () {

});

Route::middleware(['auth','verified'])->group(function () {
	Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');

	Route::get('/tower/add', 			[TowerController::class, 'newTowerView'])->withoutMiddleware(UserIsAdmin::class)->name('new-tower');
	Route::get('/tower/{tower_name}', 	[TowerController::class, 'singleTower']);
	Route::post('/tower/add', 			[TowerController::class, 'createTower'])->withoutMiddleware(UserIsAdmin::class)->name('create-tower');
});


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

// TODO make 404 page