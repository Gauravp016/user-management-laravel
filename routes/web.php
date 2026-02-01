<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

/**
 * User Management (Blade)
 */
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

/**
 * CHANGE THIS ⬇
 */
// Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

/**
 * TO THIS ⬇
 */
Route::post('/users/{user}/update', [UserController::class, 'update'])
    ->name('users.update');

