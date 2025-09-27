<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WordsController;
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
    Route::get('/words', [WordsController::class, 'index'])->name('index');
    Route::get('/words/{letter}', [WordsController::class, 'show'])->name('words.show');
    Route::get('/words/create', [WordsController::class, 'create'])->name('words.create');
    Route::post('/words', [WordsController::class, 'store'])->name('words.store');
});
