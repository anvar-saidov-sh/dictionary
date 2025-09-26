<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [StudentController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [StudentController::class, 'register']);

Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentController::class, 'login']);

Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', function () {
        return view('students.dashboard');
    })->name('dashboard');
    Route::get('/words', function (){
        return view('words.index');
    })->name('index');
});

