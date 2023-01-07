<?php

use App\Events\PrivateNotification;
use App\Events\PublicNotification;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ResennaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrazasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeografiaVenezuelaController;
use App\Http\Controllers\JerarquiaController;
use App\Http\Controllers\NomencladoresController;
use App\Http\Controllers\MapsGeoreferenceController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::resource('sessions', SessionsController::class)->middleware('auth');

Route::resource('messages', MessagesController::class)->middleware('auth');

Route::get('/', [LoginController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/settings/user', [App\Http\Controllers\UserController::class, 'settings'])->name('users.settings')->middleware('auth');

Route::get('/historial_sesion', [App\Http\Controllers\TrazasController::class, 'index_historial_sesion'])->name('historial_sesion.index')->middleware('auth');

Route::get('/trazasResennas', [App\Http\Controllers\TrazasController::class, 'index_resenna'])->name('traza_resenna.index')->middleware('auth');

Route::get('/trazasFuncionarios', [App\Http\Controllers\TrazasController::class, 'index_funcionarios'])->name('traza_funcionarios.index')->middleware('auth');

Route::get('/trazasUsers', [App\Http\Controllers\TrazasController::class, 'index_usuarios'])->name('traza_user.index')->middleware('auth');

Route::get('/trazasRoles', [App\Http\Controllers\TrazasController::class, 'index_roles'])->name('traza_roles.index')->middleware('auth');

Route::get('/trazasSesiones', [App\Http\Controllers\TrazasController::class, 'index_sesiones'])->name('traza_sesiones.index')->middleware('auth');

Route::get('/trazasPermisos', [App\Http\Controllers\TrazasController::class, 'index_permisos'])->name('traza_permisos.index')->middleware('auth');

Route::get('/trazasRutasAlmacenamiento', [App\Http\Controllers\TrazasController::class, 'index_rutas_almacenamiento'])->name('traza_rutasAlmacenamiento.index')->middleware('auth');

Route::get('/trazas/resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'show_resenna'])->name('traza_resenna.show')->middleware('auth');

Route::get('/trazas/funcionarios/{funcionario}', [App\Http\Controllers\TrazasController::class, 'show_funcionarios'])->name('traza_funcionarios.show')->middleware('auth');

Route::get('/trazas/users/{user}', [App\Http\Controllers\TrazasController::class, 'show_usuarios'])->name('traza_user.show')->middleware('auth');

Route::get('/trazas/roles/{role}', [App\Http\Controllers\TrazasController::class, 'show_roles'])->name('traza_roles.show')->middleware('auth');

Route::get('/trazas/sesiones/{sesion}', [App\Http\Controllers\TrazasController::class, 'show_sesiones'])->name('traza_sesiones.show')->middleware('auth');

Route::get('/trazas/permisos/{permiso}', [App\Http\Controllers\TrazasController::class, 'show_permisos'])->name('traza_permisos.show')->middleware('auth');

Route::get('/trazas/rutas/almacenamiento/{ruta}', [App\Http\Controllers\TrazasController::class, 'show_rutas_almacenamiento'])->name('traza_rutasAlmacenamiento.show')->middleware('auth');

Route::get('/configuraciones', [App\Http\Controllers\ConfiguracionesController::class, 'index'])->name('configuraciones.index')->middleware('auth');

Route::get('/configuraciones/permisos', [App\Http\Controllers\ConfiguracionesController::class, 'index_permisos'])->name('permisos.index')->middleware('auth');

Route::get('/configuraciones/permisos/create', [App\Http\Controllers\ConfiguracionesController::class, 'create_permisos'])->name('permisos.create')->middleware('auth');

Route::get('/configuraciones/permisos/{permiso}/edit', [ConfiguracionesController::class, 'edit_permisos'])->name('permisos.edit')->middleware('auth');

Route::get('/configuraciones/rutas/almacenamiento', [App\Http\Controllers\ConfiguracionesController::class, 'index_rutasAlmacenamiento'])->name('rutasAlmacenamiento.index')->middleware('auth');

Route::get('/configuraciones/rutas/almacenamiento/create', [App\Http\Controllers\ConfiguracionesController::class, 'create_rutasAlmacenamiento'])->name('rutasAlmacenamiento.create')->middleware('auth');

Route::get('/configuraciones/rutas/almacenamiento/{almacenamiento}/edit', [ConfiguracionesController::class, 'edit_rutasAlmacenamiento'])->name('rutasAlmacenamiento.edit')->middleware('auth');

Route::get('/nomencladores', [NomencladoresController::class, 'index'])->name('nomencladores.index')->middleware('auth');

Route::get('/nomencladores/jerarquia', [NomencladoresController::class, 'index_jerarquia'])->name('jerarquia.index')->middleware('auth');

Route::get('/nomencladores/jerarquia/create', [NomencladoresController::class, 'create_jerarquia'])->name('jerarquia.create')->middleware('auth');

Route::get('/nomencladores/jerarquia/{jerarquia}/edit', [NomencladoresController::class, 'edit_jerarquia'])->name('jerarquia.edit')->middleware('auth');

Route::get('/nomencladores/organismoSeguridad', [NomencladoresController::class, 'index_organismoSeguridad'])->name('organismoSeguridad.index')->middleware('auth');

Route::get('/nomencladores/organismoSeguridad/create', [NomencladoresController::class, 'create_organismoSeguridad'])->name('organismoSeguridad.create')->middleware('auth');

Route::get('/nomencladores/organismoSeguridad/{organismo}/edit', [NomencladoresController::class, 'edit_organismoSeguridad'])->name('organismoSeguridad.edit')->middleware('auth');

Route::get('/nomencladores/estatusFuncionario', [NomencladoresController::class, 'index_estatusFuncionario'])->name('estatusFuncionario.index')->middleware('auth');

Route::get('/nomencladores/estatusFuncionario/create', [NomencladoresController::class, 'create_estatusFuncionario'])->name('estatusFuncionario.create')->middleware('auth');

Route::get('/nomencladores/estatusFuncionario/{estatusFuncionario}/edit', [NomencladoresController::class, 'edit_estatusFuncionario'])->name('estatusFuncionario.edit')->middleware('auth');

Route::get('/resenna/pdf/{resenna}', [App\Http\Controllers\ResennaController::class, 'pdf'])->name('resenna.pdf')->middleware('auth');

Route::get('resenna/create/select/{id}/{id_hijo}', [App\Http\Controllers\GeografiaVenezuelaController::class, 'getCombo']);

Route::get('resenna/{id}/edit/select/{tipo}/{id_hijo}', [App\Http\Controllers\GeografiaVenezuelaController::class, 'getCombos']);

Route::get('resenna/verify/{id}', [ResennaController::class, 'verifyNewStore'])->name('resenna.verify')->middleware('auth');

Route::get('/restore/resenna', [ResennaController::class, 'restoreIndex'])->name('resenna.restore.index')->middleware('auth');

Route::get('/restore/resenna/{id}', [ResennaController::class, 'restore'])->name('resenna.restore')->middleware('auth');

Route::get('/restore/all/resenna/', [ResennaController::class, 'restoreAll'])->name('resenna.restore.all')->middleware('auth');

Route::get('charts/resenna', [ResennaController::class, 'charts'])->name('resenna.charts')->middleware('auth');

Route::get('/georeference/search', [MapsGeoreferenceController::class, 'searchLocation'])->name('georeference.search');

Route::get('/resenna/mail', [EmailController::class, 'index'])->name('resenna.mail')->middleware('auth');

Route::get('/password/forgot', [ForgotPasswordController::class, 'index'])->name('password.forgot');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs')->middleware('auth');

Route::get('/abstract_messages', [MessagesController::class, 'abstract'])->name('messages.abstract')->middleware('auth');

Route::get('/jerarquia/{jerarquia}', [JerarquiaController::class, 'getJerarquiaByOrganismo'])->name('jerarquia.select')->middleware('auth');

Route::get('logout/{id}', [LoginController::class, 'logout'])->middleware('auth');

Route::post('/password/mail', [ForgotPasswordController::class, 'sendMail'])->name('password.mail');

Route::post('/password/reset', [ResetPasswordController::class, 'index'])->name('password.reset');

Route::patch('/trazas/resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'update_resenna'])->name('traza_resenna.update')->middleware('auth');

Route::patch('/trazas/funcionarios/{funcionario}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_funcionarios.update')->middleware('auth');

Route::patch('/trazas/users/{user}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_user.update')->middleware('auth');

Route::patch('/trazas/roles/{role}', [App\Http\Controllers\TrazasController::class, 'update_roles'])->name('traza_roles.update')->middleware('auth');

Route::patch('/reset{user}', [UserController::class, 'ResetPassword'])->name('users.reset')->middleware('auth');

Route::patch('/users/{user}/status', [UserController::class, 'update_status'])->name('users.update_status')->middleware('auth');

Route::patch('/configuraciones/permisos/{permiso}', [ConfiguracionesController::class, 'update_permisos'])->name('permisos.update')->middleware('auth');

Route::patch('/configuraciones/rutas/almacenamiento/{almacenamiento}', [ConfiguracionesController::class, 'update_rutasAlmacenamiento'])->name('rutasAlmacenamiento.update')->middleware('auth');

Route::patch('/nomencladores/jerarquia/{jerarquia}', [NomencladoresController::class, 'update_jerarquia'])->name('jerarquia.update')->middleware('auth');

Route::patch('/nomencladores/organismoSeguridad/{organismo}', [NomencladoresController::class, 'update_organismoSeguridad'])->name('organismoSeguridad.update')->middleware('auth');

Route::patch('/nomencladores/estatusFuncionario/{estatusFuncionario}', [NomencladoresController::class, 'update_estatusFuncionario'])->name('estatusFuncionario.update')->middleware('auth');

Route::patch('/settings/user/{user}', [UserController::class, 'settings_update'])->name('users.settings.update')->middleware('auth');

Route::post('logout/{id}', [LoginController::class, 'logout'])->middleware('auth');

Route::post('/configuraciones/permisos', [ConfiguracionesController::class, 'store_permisos'])->name('permisos.store')->middleware('auth');

Route::post('/configuraciones/rutas/almacenamiento', [ConfiguracionesController::class, 'store_rutasAlmacenamiento'])->name('rutasAlmacenamiento.store')->middleware('auth');

Route::post('/nomencladores/jerarquia', [NomencladoresController::class, 'store_jerarquia'])->name('jerarquia.store')->middleware('auth');

Route::post('/nomencladores/organismoSeguridad', [NomencladoresController::class, 'store_organismoSeguridad'])->name('organismoSeguridad.store')->middleware('auth');

Route::post('/nomencladores/estatusFuncionario', [NomencladoresController::class, 'store_estatusFuncionario'])->name('estatusFuncionario.store')->middleware('auth');

Route::delete('/configuraciones/permisos/{permiso}', [ConfiguracionesController::class, 'destroy_permisos'])->name('permisos.destroy')->middleware('auth');

Route::delete('/configuraciones/rutas/almacenamiento/{almacenamiento}', [ConfiguracionesController::class, 'destroy_rutasAlmacenamiento'])->name('rutasAlmacenamiento.destroy')->middleware('auth');

Route::delete('/nomencladores/jerarquia/{jerarquia}', [NomencladoresController::class, 'destroy_jerarquia'])->name('jerarquia.destroy')->middleware('auth');

Route::delete('/nomencladores/organismoSeguridad/{organismo}', [NomencladoresController::class, 'destroy_organismoSeguridad'])->name('organismoSeguridad.destroy')->middleware('auth');

Route::delete('/nomencladores/estatusFuncionario/{estatusFuncionario}', [NomencladoresController::class, 'destroy_estatusFuncionario'])->name('estatusFuncionario.destroy')->middleware('auth');

// Ruta para colocar buscador en tiempo real 
// Route::get('resenna/search/{cedula}', [ResennaController::class, 'search'])->name('resenna.search')->middleware('auth');

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

//// En General ////

// Preferiblemente realizar controladores propios para envio de link a correo para reestablecer contraseña
