<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [])->name('auth.login');
Route::get('/register', [])->name('auth.register');
