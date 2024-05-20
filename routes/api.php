<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\Api\RegisterController::class,'register'])->name('register');
Route::post('/login', [App\Http\Controllers\Api\LoginController::class,'login'])->name('login');



Route::middleware(['userRoleOnly:admin,user'])->group(function () {
    Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'ambilSemua'])->name('ambilSemua');
    Route::post('/products', [App\Http\Controllers\Api\ProductController::class, 'tambah'])->name('tambah');

    Route::delete('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'hapus'])->name('hapus');
    Route::put('/products/{id}', [App\Http\Controllers\Api\ProductController::class], 'ubah')->name('ubah');
    Route::get('/products/{id}', [App\Http\Controllers\Api\ProductController::class], 'ambil')->name('ambil');
});

Route::middleware(['userRoleOnly:admin'])->group(function () {
    Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class,'ambilSemua'])->name('ambilSemua');
    Route::post('/categories', [App\Http\Controllers\Api\CategoryController::class, 'tambah'])->name('tambah');

    Route::get('/categories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'ambil'])->name('ambil');
    Route::delete('/categories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'hapus'])->name('hapus');
    Route::put('/categories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'ubah'])->name('ubah');
});
