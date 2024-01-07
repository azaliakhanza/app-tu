<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LetterTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;

Route::middleware('IsGuest')->group(function() {
    Route::get('/', function () {
        return view('login');
    })->name('login');
});

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');

Route::get('/', function () {
    return view('home');
});


// Route::prefix('/admin')->name('admint.')->group(function() {
//     Route::get('/dashboard', [dashboardController::class, 'index'])->name('index');

// });


Route::prefix('/data-klasifikasi-surat')->name('data-klasifikasi-surat.')->group(function() {
    Route::get('/', [LetterTypeController::class, 'index'])->name('index');
    Route::delete('/{id}', [LetterTypeController::class, 'delete'])->name('delete');
    Route::get('/{id}/edit', [LetterTypeController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
    Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
    Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
});

Route::prefix('/staff')->name('staff.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::prefix('/guru')->name('guru.')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->name('index');
    Route::get('/create', [GuruController::class, 'create'])->name('create');
    Route::post('/store', [GuruController::class, 'store'])->name('store');
    Route::get('/{id}', [GuruController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [GuruController::class, 'update'])->name('update');
    Route::delete('/{id}', [GuruController::class, 'destroy'])->name('destroy');
});

Route::middleware('IsLogin')->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function(){
        return view('home');
    })->name('home');
});
