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


Route::get('dashboard', [DashboardController::class, 'index']);

// Student Route
Route::get('/student/list', [StudentController::class, 'listView']);

Route::get('/api/student/list', [StudentController::class, 'list']);

Route::get('/student/create', [StudentController::class, 'create']);
Route::post('/student/insert', [StudentController::class, 'insert']);

Route::get('/student/edit/{id}', [StudentController::class, 'edit']);
Route::post('/student/update/{id}', [StudentController::class, 'update']);

Route::get('/student/delete/{id}', [StudentController::class, 'delete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
