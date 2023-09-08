<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guests\PageController as GuestsPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestsPageController::class, 'home'])->name('guests.home');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        // Dashboard
        Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');

        // Apartment resource
        Route::resource('apartments', ApartmentController::class);

        // All apartment sponsors
        Route::get('apartments/{apartment}/sponsors', [ApartmentController::class, 'sponsors'])->name('apartments.sponsors');

        // All apartment messages
        Route::get('apartments/{apartment}/messages/', [ApartmentController::class, 'messages'])->name('apartments.messages');

        // All user messages per apartment
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

        // All user sponsor per apartment
        Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors.index');

        // Payment process
        Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process_payment');
    });

Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
require __DIR__ . '/auth.php';