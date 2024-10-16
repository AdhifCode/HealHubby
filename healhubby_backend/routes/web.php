<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Auth\SocialiteController;
use App\Http\Controllers\HomeController;

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

Route::get('/api/getuserdata/{id}', [UserController::class, 'userData']);

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
    Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// ID App Meta 902458841298687
// Key App Meta 66b6d838097b1afc5f99412fb2efdb79
