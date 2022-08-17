<?php

use App\Http\Controllers\SesionController;
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

Route::get('/', function () { return view('auth.login'); });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/historial_sesion', [App\Http\Controllers\TrazasController::class, 'index_historial_sesion'])->name('historial_sesion.index')->middleware('auth');

Route::get('/traza_resennas', [App\Http\Controllers\TrazasController::class, 'index_resenna'])->name('traza_resenna.index')->middleware('auth');

Route::get('/traza_users', [App\Http\Controllers\TrazasController::class, 'index_usuarios'])->name('traza_user.index')->middleware('auth');

Route::get('/traza_roles', [App\Http\Controllers\TrazasController::class, 'index_roles'])->name('traza_roles.index')->middleware('auth');

Route::get('/traza_resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'show_resenna'])->name('traza_resenna.show')->middleware('auth');

Route::get('/traza_users/{user}', [App\Http\Controllers\TrazasController::class, 'show_usuarios'])->name('traza_user.show')->middleware('auth');

Route::get('/traza_roles/{role}', [App\Http\Controllers\TrazasController::class, 'show_roles'])->name('traza_roles.show')->middleware('auth');

Route::patch('/traza_resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'update_resenna'])->name('traza_resenna.update')->middleware('auth');

Route::patch('/traza_users/{user}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_user.update')->middleware('auth');

Route::patch('/traza_roles/{role}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_roles.update')->middleware('auth');

Route::patch('/reset{user}', [UserController::class, 'ResetPassword'])->name('users.reset')->middleware('auth');

Route::patch('/user/{user}/status', [UserController::class, 'update_status'])->name('users.update_status')->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');

Route::resource('roles', RoleController::class)->middleware('auth');

Route::resource('resenna', ResennaController::class)->middleware('auth');

Route::resource('trazas', TrazasController::class)->middleware('auth');

Route::resource('sesion', SesionController::class)->middleware('auth');

Auth::routes();
