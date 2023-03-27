<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ApartmentController;
use App\Http\Controllers\BraintreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api_token')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', [UserController::class, 'store'])->name('api.user.store');
Route::get('/user/{user}', [UserController::class, 'show'])->name('api.user.show');
Route::post('login', [UserController::class, 'login'])->name('login');


Route::get('/apartments', [ApartmentController::class, 'index'])->name('api.apartments.index');
Route::get('/apartments/{apartment}', [ ApartmentController::class, 'show'])->name('api.apartments.show');
Route::get('/apartments/filter/{rooms?}/{beds?}', [ApartmentController::class, 'servicesFilter'])->name('api.apartments.filter');
