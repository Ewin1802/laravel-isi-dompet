<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// AUTH
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);


// USERS
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

// ADMIN
Route::resource('/admin', AdminController::class);
