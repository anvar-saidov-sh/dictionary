<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', AuthController::class)->name('register');
});

Route::middleware('auth')->group(function () {

});
