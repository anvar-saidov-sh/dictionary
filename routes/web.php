<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WordRequestController;
use App\Http\Controllers\WordsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('students.dashboard');
});


Route::get('/register', [StudentController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [StudentController::class, 'register']);
Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentController::class, 'login']);
Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/words', [WordsController::class, 'index'])->name('index');
    Route::get('/words/create', [WordsController::class, 'create'])->name('words.create');
    Route::post('/words', [WordsController::class, 'store'])->name('words.store');
    Route::get('/words/{letter}', [WordsController::class, 'show'])->name('words.show');
    Route::get('/profile', [StudentController::class, 'show'])->name('students.index');
    Route::get('/words/{letter}/{word}/review', [WordsController::class, 'review'])->name('words.review');
    Route::get('/words/{letter}/{word}/edit', [WordsController::class, 'edit'])->name('words.edit');
    Route::put('/words/{letter}/{word}', [WordsController::class, 'update'])->name('words.update');
    Route::delete('/words/{letter}/{word}', [WordsController::class, 'destroy'])->name('words.destroy');
    Route::get('/words/{letter}/{word}/request', [WordRequestController::class, 'create'])->name('words.requests.create');
    Route::post('/words/{letter}/{word}/request', [WordRequestController::class, 'store'])->name('words.requests.store');
    Route::post('/requests/{id}/approve', [WordRequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [WordRequestController::class, 'reject'])->name('requests.reject');
});
