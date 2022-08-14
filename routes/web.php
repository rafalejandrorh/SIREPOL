<?php

use App\Http\Controllers\ResennaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrazasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');

Route::resource('roles', RoleController::class)->middleware('auth');

Route::resource('resenna', ResennaController::class)->middleware('auth');

Route::resource('trazas', TrazasController::class)->middleware('auth');

Auth::routes();
