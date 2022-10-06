<?php

use App\Events\PrivateNotification;
use App\Events\PublicNotification;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ResennaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrazasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeografiaVenezuelaController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Mail;

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

Route::resource('geografia_venezuela',GeografiaVenezuelaController::class);

Route::resource('users', UserController::class)->middleware('auth');

Route::resource('funcionarios', FuncionarioController::class)->middleware('auth');

Route::resource('roles', RoleController::class)->middleware('auth');

Route::resource('resenna', ResennaController::class)->middleware('auth');

Route::resource('trazas', TrazasController::class)->middleware('auth');

Route::resource('sesion', SesionController::class)->middleware('auth');

Route::get('/', [LoginController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/historial_sesion', [App\Http\Controllers\TrazasController::class, 'index_historial_sesion'])->name('historial_sesion.index')->middleware('auth');

Route::get('/traza_resennas', [App\Http\Controllers\TrazasController::class, 'index_resenna'])->name('traza_resenna.index')->middleware('auth');

Route::get('/traza_funcionarios', [App\Http\Controllers\TrazasController::class, 'index_funcionarios'])->name('traza_funcionarios.index')->middleware('auth');

Route::get('/traza_users', [App\Http\Controllers\TrazasController::class, 'index_usuarios'])->name('traza_user.index')->middleware('auth');

Route::get('/traza_roles', [App\Http\Controllers\TrazasController::class, 'index_roles'])->name('traza_roles.index')->middleware('auth');

Route::get('/traza_resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'show_resenna'])->name('traza_resenna.show')->middleware('auth');

Route::get('/traza_funcionario/{funcionario}', [App\Http\Controllers\TrazasController::class, 'show_funcionarios'])->name('traza_funcionarios.show')->middleware('auth');

Route::get('/traza_users/{user}', [App\Http\Controllers\TrazasController::class, 'show_usuarios'])->name('traza_user.show')->middleware('auth');

Route::get('/traza_roles/{role}', [App\Http\Controllers\TrazasController::class, 'show_roles'])->name('traza_roles.show')->middleware('auth');

Route::get('/resenna_pdf/{resenna}', [App\Http\Controllers\ResennaController::class, 'pdf'])->name('resenna.pdf')->middleware('auth');

Route::get('resenna/create/select/{id}/{id_hijo}', [App\Http\Controllers\GeografiaVenezuelaController::class, 'getCombo']);

Route::get('resenna/{id}/edit/select/{tipo}/{id_hijo}', [App\Http\Controllers\GeografiaVenezuelaController::class, 'getCombos']);

Route::patch('/traza_resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'update_resenna'])->name('traza_resenna.update')->middleware('auth');

Route::patch('/traza_funcionarios/{funcionario}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_funcionarios.update')->middleware('auth');

Route::patch('/traza_users/{user}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_user.update')->middleware('auth');

Route::patch('/traza_roles/{role}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_roles.update')->middleware('auth');

Route::patch('/reset{user}', [UserController::class, 'ResetPassword'])->name('users.reset')->middleware('auth');

Route::patch('/user/{user}/status', [UserController::class, 'update_status'])->name('users.update_status')->middleware('auth');

Route::post('logout/{id}', [LoginController::class, 'logout']);

Route::get('resenna/search/{cedula}', [ResennaController::class, 'search'])->name('resenna.search')->middleware('auth');

Auth::routes();

// Route::get('/notification/{message}', function($message){ 
//     event(new PublicNotification($message)); 
//     dd('Notificación Pública');
//     Alert()->success('Usuario Creado Satisfactoriamente');
//     return redirect()->route('users.index'); 
// })->name('notification');

// Route::get('/private-notification', function(){ 
//     event(new PrivateNotification(auth()->user()));
//     dd('Notificación Privada'); 
// });
