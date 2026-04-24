<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// /*
// |---------------------------------------
// | AUTH VIEW
// |---------------------------------------
// */

// Route::view('/login','auth.login')->name('login');

// Route::view('/register','auth.register')->name('register');

// Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// /*
// |---------------------------------------
// | DASHBOARD
// |---------------------------------------
// */

// Route::middleware(['auth'])->group(function () {

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     Route::get('/admin',[AdminController::class,'index'])->name('admin.index');

//     Route::get('/admin/create',[AdminController::class,'create'])->name('admin.create');

//     Route::post('/admin/store',[AdminController::class,'store'])->name('admin.store');

//     Route::get('/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');

//     Route::post('/admin/update/{id}',[AdminController::class,'update'])->name('admin.update');

//     Route::delete('/admin/delete/{id}',[AdminController::class,'destroy'])->name('admin.delete');

//     Route::get('/users', [UserController::class,'index'])->name('users.index');

// Route::post('/users/update/{id}', [UserController::class,'update'])->name('users.update');

// Route::delete('/users/delete/{id}', [UserController::class,'delete'])->name('users.delete');

// });
// ================= AUTH =================

// login
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// register
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');


// ================= PROTECTED =================

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::resource('admin', AdminController::class);

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::post('/users/update/{id}', [UserController::class,'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class,'delete'])->name('users.delete');

});
