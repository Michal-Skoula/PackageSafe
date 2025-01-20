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

Route::get('/', [AppController::class, 'index'])->name('index');
Route::get('/database', [AppController::class, 'database'])->middleware([UserIsAdmin::class])->name('database');


Route::middleware(['auth','verified'])->group(function () {
	Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard');

	Route::get('/tower/add', 			[TowerController::class, 'newTowerView'])->middleware(UserIsAdmin::class)->name('new-tower');
	Route::get('/tower/{tower_name}', 	[TowerController::class, 'singleTower']);
	Route::post('/tower/add', 			[TowerController::class, 'createTower'])->middleware(UserIsAdmin::class)->name('create-tower');
});
Route::post('/towers/{id}', [DataCollectionController::class, 'ingest'])->withoutMiddleware(VerifyCsrfToken::class)->name('ingest');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';



Route::get('{any}', fn() => route('index'));