<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchandiseController;

// Public Routes
Route::get('/', [MerchandiseController::class, 'catalog'])->name('catalog');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Protected Admin Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/dashboard', [MerchandiseController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/merchandise/pdf', [MerchandiseController::class, 'exportPDF'])->name('admin.merchandise.pdf');
    
    // CRUD Operations
    Route::get('/admin/merchandise/create', [MerchandiseController::class, 'create'])->name('admin.merchandise.create');
    Route::post('/admin/merchandise', [MerchandiseController::class, 'store'])->name('admin.merchandise.store');
    Route::get('/admin/merchandise/{id}/edit', [MerchandiseController::class, 'edit'])->name('admin.merchandise.edit');
    Route::put('/admin/merchandise/{id}', [MerchandiseController::class, 'update'])->name('admin.merchandise.update');
    Route::delete('/admin/merchandise/{id}', [MerchandiseController::class, 'destroy'])->name('admin.merchandise.destroy');
});
