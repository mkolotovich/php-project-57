<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('task_statuses', [StatusController::class, 'index'])
  ->name('task_statuses.index'); 
Route::get('task_statuses/create', [StatusController::class, 'create'])
  ->name('task_statuses.create');
Route::post('task_statuses', [StatusController::class, 'store'])
  ->name('task_statuses.store');
Route::get('task_statuses/{id}/edit', [StatusController::class, 'edit'])
  ->name('task_statuses.edit');
Route::patch('task_statuses/{id}', [StatusController::class, 'update'])
  ->name('task_statuses.update');
Route::delete('task_statuses/{id}', [StatusController::class, 'destroy'])
  ->name('task_statuses.destroy');

require __DIR__.'/auth.php';
