<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SponsorController;
use App\Http\Controllers\Api\ApartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('apartments', [ApartmentController::class, 'index'])->name('api.apartments.index');
Route::get('apartments/{apartment}', [ApartmentController::class, 'show'])->name('api.apartments.show');
Route::get('/search', [ApartmentController::class, 'search']);

Route::get('images', [ImageController::class, 'index'])->name('api.images.index');

Route::get('messages', [MessageController::class, 'index'])->name('api.messages.index');
Route::post('/messages/store', [MessageController::class, 'store'])->name('api.messages.index');

Route::get('services', [ServiceController::class, 'index'])->name('api.services.index');
Route::get('sponsors', [SponsorController::class, 'index'])->name('api.sponsors.index');

Route::get('views', [ViewController::class, 'index'])->name('api.views.index');