<?php

use App\Http\Controllers\DataCollectionController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserIsAdmin;
use Carbon\Carbon;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function () {
//	$data_type = 'temperature';
//	$data = new DataCollectionController();
//	dd(array_key_exists($data_type, $data->allowed_data_types));
	$today = now()->format('Y-m-d');
	dd($today);

});

Route::post('/ingest/{id}', [DataCollectionController::class, 'ingest'])->withoutMiddleware(VerifyCsrfToken::class)->name('ingest');

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

