<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
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


Route::get('dashboard', [DashboardController::class, 'index']);

// Student Route
Route::get('/student/list', [StudentController::class, 'listView']);

Route::get('/api/student/list', [StudentController::class, 'list']);
