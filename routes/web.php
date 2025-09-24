<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'showRegister']);
Route::get('/login', [AuthController::class, 'showLogin']);
