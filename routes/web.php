<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
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
->only(['create', 'store', 'edit', 'update', 'destroy'])
->middleware('auth');
Route::resource('listing', ListingController::class)
->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::controller(AuthController::class)->group(function(){
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store')->name('login.store');
    Route::delete('logout', 'destroy')->name('logout');
});

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')
    ->middleware('auth')
    ->name('realtor.')
    ->group(function(){
        Route::resource('listing', RealtorListingController::class)
            ->only('index');
    });
