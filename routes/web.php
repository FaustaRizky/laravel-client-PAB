<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/users', \App\Http\Controllers\UserController::class);

// Rute untuk login
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Rute untuk menampilkan form tambah barang
Route::get('/items/create', [UserController::class, 'showAddItemForm'])->name('items.create');

// Rute untuk menyimpan barang
Route::post('/items', [UserController::class, 'storeItem'])->name('items.store');

// Menampilkan daftar barang
Route::get('/items', [UserController::class, 'showItems'])->name('items.index');

Route::get('/checkout/{itemId}', [UserController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout/{itemId}', [UserController::class, 'processCheckout'])->name('checkout.process');

Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');
