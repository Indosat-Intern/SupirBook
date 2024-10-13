<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\RedirectIfNotCustomer;
use App\Http\Controllers\Customer\RegisteredUserController;
use App\Http\Controllers\Customer\AuthenticatedSessionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BookingController;


Route::get('/', [IndexController::class, 'index'])
    ->name('welcome');

Route::middleware('auth:customer')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');
    Route::get('/booking-history', [BookingController::class, 'history'])->name('booking.history');
});

Route::get('/customer-register', [RegisteredUserController::class, 'create'])
    ->middleware('guest:customer')
    ->name('customer.register');

Route::post('/customer-register', [RegisteredUserController::class, 'store'])
    ->middleware('guest:customer');

Route::get('/customer-login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest:customer')
    ->name('customer.login');

Route::post('/customer-login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest:customer');

Route::post('/customer-logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('customer.logout')
    ->middleware('auth:customer');

require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     return view('customerss.index');
// })->name('welcome');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// Route::get('/customer-dashboard', function () {
//     return view('customer.dashboard');
// })->middleware(['auth:customer'])->name('customer.dashboard');

// Route::middleware('guest')->group(function () {
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])
//                 ->name('login');
//     Route::post('login', [AuthenticatedSessionController::class, 'store']);
//     // ... other auth routes
// });

// Route::middleware([RedirectIfNotCustomer::class])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
//     // ... other customer routes
// });
