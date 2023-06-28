<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use App\Models\Offer;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(IndexController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/hello', 'show');
});

Route::resource('listing', ListingController::class)
->only(['index', 'show']);

Route::resource('listing.offer', ListingOfferController::class)
->only(['store'])
->middleware('auth');

Route::resource('notification', NotificationController::class)
    ->only(['index'])
    ->middleware('auth');

Route::put(
    'notification/{notification}/seen',
    NotificationSeenController::class
)->middleware('auth')->name('notification.seen');

Route::controller(AuthController::class)->group(function(){
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store')->name('login.store');
    Route::delete('logout', 'destroy')->name('logout');
});

//email verification
Route::controller(EmailVerificationController::class)
    ->group(function(){
    Route::get('/email/verify', 'verificationNotice')
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', 'verificationSend')
        ->middleware('throttle:6,1')
        ->name('verification.send');
})->middleware('auth');

// Route::get('/email/verify', [EmailVerificationController::class, 'verificationNotice'])
//     ->middleware('auth')
//     ->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
//     ->middleware(['auth', 'signed'])
//     ->name('verification.verify');

// Route::post('/email/verification-notification', [EmailVerificationController::class, 'verificationSend'])
//     ->middleware(['auth', 'throttle:6,1'])
//     ->name('verification.send');
//

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')
    ->middleware(['auth', 'verified'])
    ->name('realtor.')
    ->group(function () {
        Route::name('listing.restore')
            ->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
            ->withTrashed();

        Route::resource('listing', RealtorListingController::class)
            ->withTrashed();

        Route::name('offer.accept')
            ->put(
                'offer/{offer}/accept',
                RealtorListingAcceptOfferController::class
            );

        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store','destroy']);
    });
