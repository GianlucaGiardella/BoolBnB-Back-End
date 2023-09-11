<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SponsorController;
use App\Http\Controllers\Api\ViewController as ApiViewController;
use App\Http\Controllers\Api\ApartmentController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Laravel\Sanctum\Http\Controllers\AuthenticatedSessionController;
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

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);

Route::get('apartments', [ApartmentController::class, 'index'])->name('api.apartments.index');
Route::get('apartments/{apartment}', [ApartmentController::class, 'show'])->name('api.apartments.show');
Route::get('/search', [ApartmentController::class, 'search']);
// Route::get('/search', [ApartmentController::class, 'getCity']); FIXME:

Route::get('images', [ImageController::class, 'index'])->name('api.images.index');

Route::get('messages', [MessageController::class, 'index'])->name('api.messages.index');
Route::post("/messages/store", [MessageController::class, "store"])->name('api.messages.store');

Route::get('services', [ServiceController::class, 'index'])->name('api.services.index');
Route::get('sponsors', [SponsorController::class, 'index'])->name('api.sponsors.index');
Route::post("/view/store", [ApiViewController::class, "store"]);
