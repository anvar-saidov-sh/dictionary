<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('student/register', [StudentController::class, 'showRegisterForm'])->name('student.register');
Route::post('student/register', [StudentController::class, 'register']);

Route::get('student/login', [StudentController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentController::class, 'login']);

Route::post('student/logout', [StudentController::class, 'logout'])->name('student.logout');

Route::middleware('auth:student')->group(function () {
    Route::get('student/dashboard', function () {
        return view('students.dashboard');
    })->name('student.dashboard');
});

