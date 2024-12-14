<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// ===========================
// Admin Routes
// ===========================
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('restaurants.index');

    // Restaurant Management
    Route::get('/restaurants', [AdminController::class, 'restaurants'])->name('restaurants');
    Route::get('/restaurants/create', [AdminController::class, 'createRestaurant'])->name('restaurants.create');
    Route::post('/restaurants/store', [AdminController::class, 'storeRestaurant'])->name('restaurants.store');
    Route::get('/restaurants/{id}/edit', [AdminController::class, 'editRestaurant'])->name('restaurants.edit');
    Route::put('/restaurants/{id}/update', [AdminController::class, 'updateRestaurant'])->name('restaurants.update');
    Route::delete('/restaurants/{id}', [AdminController::class, 'deleteRestaurant'])->name('restaurants.destroy');
    Route::get('/restaurants/{id}', [AdminController::class, 'showRestaurant'])->name('restaurants.show');

    // Reservation Management

    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations.index');
    Route::post('/reservations/{id}/approve', [AdminController::class, 'approveReservation'])->name('reservations.approve');
    Route::post('/reservations/{id}/reject', [AdminController::class, 'rejectReservation'])->name('reservations.reject');
    

    // Table Management
    Route::get('/restaurants/{restaurantId}/tables/create', [AdminController::class, 'createTable'])->name('tables.create');
    Route::post('/restaurants/{restaurantId}/tables', [AdminController::class, 'storeTable'])->name('tables.store');
    Route::get('/tables/{id}/edit', [AdminController::class, 'editTable'])->name('tables.edit');
    Route::put('/tables/{id}', [AdminController::class, 'updateTable'])->name('tables.update');
    Route::delete('/tables/{id}', [AdminController::class, 'deleteTable'])->name('tables.delete');
});

// ===========================
// Customer Routes
// ===========================
Route::prefix('customer')->name('customer.')->group(function () {
    // Customer Dashboard
    Route::get('/', [CustomerController::class, 'index'])->name('index');

    // Reservation Management
    Route::get('/reservations', [CustomerController::class, 'viewReservations'])->name('reservations');
    Route::post('/reservations/store', [CustomerController::class, 'storeReservation'])->name('reservations.store');
    Route::get('/reservations/{id}/edit', [CustomerController::class, 'editReservation'])->name('reservations.edit');
    Route::put('/reservations/{id}', [CustomerController::class, 'updateReservation'])->name('reservations.update');
    Route::delete('/reservations/{id}', [CustomerController::class, 'deleteReservation'])->name('reservations.destroy');

    // Restaurant Search and Details
    Route::get('/restaurants/search', [CustomerController::class, 'search'])->name('restaurants.search');
    Route::get('/restaurants/{id}', [CustomerController::class, 'showRestaurant'])->name('restaurants.show');
});

// ===========================
// Public Routes
// ===========================
Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/login', [CustomerController::class, 'showLogin'])->name('customer.login');
Route::post('/login', [CustomerController::class, 'login']);
Route::get('/restaurants', [CustomerController::class, 'index'])->name('customer.restaurants.index');
Route::get('/restaurants/search', [CustomerController::class, 'search'])->name('restaurants.search');
Route::get('/restaurants/{id}', [CustomerController::class, 'showRestaurant'])->name('customer.restaurants.show');
Route::post('/reservations/store', [CustomerController::class, 'storeReservation'])->name('customer.reservations.store');
