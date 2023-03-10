<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sameer', [SampleController::class, 'display']);


Route::get('layout', function () {
    return view('layout');
});


Route::get('user/login', [UserController::class, 'displayLogin']);
Route::post('user/dologin', [UserController::class, 'doLogin']);
Route::get('user/dologout', [UserController::class, 'doLogout']);
Route::get('user/register', [UserController::class, 'registerView']);
Route::post('user/register-post', [UserController::class, 'register']);
Route::get('email/verification/{token}', [UserController::class, 'emailVerification']);
Route::get('show/password/generate/{token}', [UserController::class, 'showPasswordGenerate']);
Route::post('password/save/{token}', [UserController::class, 'savePassword']);


Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth.check');

// Student Route
Route::middleware(['auth.check'])->group(function () {

    Route::get('/student/list', [StudentController::class, 'listView']);
    Route::get('/api/student/list', [StudentController::class, 'list']);
    Route::get('/student/create', [StudentController::class, 'create']);
    Route::post('/student/insert', [StudentController::class, 'insert']);
    Route::get('/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/student/update/{id}', [StudentController::class, 'update']);
    Route::get('/student/delete/{id}', [StudentController::class, 'delete']);
    Route::get('/student/export/excel', [StudentController::class, 'exportExcel']);
    Route::get('/student/download/image', [StudentController::class, 'downloadFile']);
    Route::get('/send/otp', [StudentController::class, 'sendOTP']);
    Route::get('/verify/otp', [StudentController::class, 'verifyOTP']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
