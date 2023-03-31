<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ApartmentController as UserApartmentController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BraintreeController;

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



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('apartments/testshow', [UserApartmentController::class, 'serviceFilter'])->name('apartments.filter');
    Route::resource('apartments', UserApartmentController::class);
    Route::patch('/apartments/{apartment}/toggle', [UserApartmentController::class, 'enableToggle'])->name('apartments.toggle');
    Route::get('/paymentForm/{apartment}/{sponsorship}', [BraintreeController::class, 'paymentForm'])->name('paymentForm');

    Route::post('/getToken', [BraintreeController::class, 'getToken'])->name('getToken');

    Route::get('/getVisualizationsData', [UserMessageController::class, 'getVisualizationStats'])->name('getVisualizationStats');
    Route::get('/messages/{apartment}', [UserMessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{message}', [UserMessageController::class, 'destroy'])->name('messages.destroy');
    Route::patch('/messages/{message}/toggle', [UserMessageController::class, 'enableToggle'])->name('messages.toggle');

    Route::get('/sponsorshipIndex/{apartment}', [BraintreeController::class, 'sponsorshipIndex'])->name('sponsorshipIndex');
});

Route::post('/checkout/{sponsorship}/{apartment}', [BraintreeController::class, 'checkout'])->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
