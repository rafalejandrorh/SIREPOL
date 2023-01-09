<?php

use App\Events\PrivateNotification;
use App\Events\PublicNotification;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RutasAlmacenamientoController;
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

Route::resource('geografiaVenezuela',GeografiaVenezuelaController::class);
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('funcionarios', FuncionarioController::class)->middleware('auth');
Route::resource('roles', RoleController::class)->middleware('auth');
Route::resource('resenna', ResennaController::class)->middleware('auth');
Route::resource('trazas', TrazasController::class)->middleware('auth');
Route::resource('sessions', SessionsController::class)->middleware('auth');
Route::resource('messages', MessagesController::class)->middleware('auth');

// Rutas Principales (Login y Home)
Route::get('/', [LoginController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


// Módulo de Georeferencia
Route::get('/georeference/search', [MapsGeoreferenceController::class, 'searchLocation'])->name('georeference.search');


// Rutas para consulta Vía Ajax (Response JSON)
Route::get('/jerarquia/{jerarquia}', [JerarquiaController::class, 'getJerarquiaByOrganismo'])->name('jerarquia.select')->middleware('auth');
Route::get('/abstractMessages', [MessagesController::class, 'abstract'])->name('messages.abstract')->middleware('auth');
Route::get('geografia/venezuela/municipio/{id}/{id_hijo}', [App\Http\Controllers\GeografiaVenezuelaController::class, 'getMunicipios'])->middleware('auth');


// Rutas Adicionales de Módulo de Usuarios
Route::get('export/users/', [UserController::class, 'exportExcel'])->name('users.export.excel')->middleware('auth');
Route::patch('/reset/{user}', [UserController::class, 'ResetPassword'])->name('users.reset')->middleware('auth');
Route::get('/status/user', [UserController::class, 'updateStatusAll'])->name('users.update_status.all')->middleware('auth');
Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.update_status')->middleware('auth');
Route::get('/settings/user', [App\Http\Controllers\UserController::class, 'settings'])->name('users.settings')->middleware('auth');
Route::patch('/settings/user/{user}', [UserController::class, 'updateSettings'])->name('users.settings.update')->middleware('auth');


// Rutas Adicionales de Módulo de Reseñas
//Route::get('/resenna/mail', [EmailController::class, 'index'])->name('resenna.mail')->middleware('auth');
Route::get('charts/resenna', [ResennaController::class, 'charts'])->name('resenna.charts')->middleware('auth');
Route::get('/resenna/pdf/{resenna}', [App\Http\Controllers\ResennaController::class, 'pdf'])->name('resenna.pdf')->middleware('auth');
Route::get('resenna/verify/{id}', [ResennaController::class, 'verifyNewStore'])->name('resenna.verify')->middleware('auth');
Route::get('/restore/resenna', [ResennaController::class, 'restoreIndex'])->name('resenna.restore.index')->middleware('auth');
Route::get('/restore/resenna/{id}', [ResennaController::class, 'restore'])->name('resenna.restore')->middleware('auth');
Route::get('/restore/all/resenna/', [ResennaController::class, 'restoreAll'])->name('resenna.restore.all')->middleware('auth');


// Módulo de Trazas
Route::get('/historialSesion', [App\Http\Controllers\TrazasController::class, 'indexHistorialSesion'])->name('historial_sesion.index')->middleware('auth');
Route::get('/trazasResennas', [App\Http\Controllers\TrazasController::class, 'indexResenna'])->name('traza_resenna.index')->middleware('auth');
Route::get('/trazasFuncionarios', [App\Http\Controllers\TrazasController::class, 'indexFuncionarios'])->name('traza_funcionarios.index')->middleware('auth');
Route::get('/trazasUsers', [App\Http\Controllers\TrazasController::class, 'indexUsuarios'])->name('traza_user.index')->middleware('auth');
Route::get('/trazasRoles', [App\Http\Controllers\TrazasController::class, 'indexRoles'])->name('traza_roles.index')->middleware('auth');
Route::get('/trazasSesiones', [App\Http\Controllers\TrazasController::class, 'indexSesiones'])->name('traza_sesiones.index')->middleware('auth');
Route::get('/trazasPermisos', [App\Http\Controllers\TrazasController::class, 'index'])->name('traza_permisos.index')->middleware('auth');
Route::get('/trazasRutasAlmacenamiento', [App\Http\Controllers\TrazasController::class, 'indexRutasAlmacenamiento'])->name('traza_rutasAlmacenamiento.index')->middleware('auth');
Route::get('/trazas/resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'showResenna'])->name('traza_resenna.show')->middleware('auth');
Route::get('/trazas/funcionarios/{funcionario}', [App\Http\Controllers\TrazasController::class, 'showFuncionarios'])->name('traza_funcionarios.show')->middleware('auth');
Route::get('/trazas/users/{user}', [App\Http\Controllers\TrazasController::class, 'showUsuarios'])->name('traza_user.show')->middleware('auth');
Route::get('/trazas/roles/{role}', [App\Http\Controllers\TrazasController::class, 'showRoles'])->name('traza_roles.show')->middleware('auth');
Route::get('/trazas/sesiones/{sesion}', [App\Http\Controllers\TrazasController::class, 'showSesiones'])->name('traza_sesiones.show')->middleware('auth');
Route::get('/trazas/permisos/{permiso}', [App\Http\Controllers\TrazasController::class, 'show'])->name('traza_permisos.show')->middleware('auth');
Route::get('/trazas/rutas/almacenamiento/{ruta}', [App\Http\Controllers\TrazasController::class, 'showRutasAlmacenamiento'])->name('traza_rutasAlmacenamiento.show')->middleware('auth');
Route::patch('/trazas/resennas/{resenna}', [App\Http\Controllers\TrazasController::class, 'updateResenna'])->name('traza_resenna.update')->middleware('auth');
Route::patch('/trazas/funcionarios/{funcionario}', [App\Http\Controllers\TrazasController::class, 'updateRoles'])->name('traza_funcionarios.update')->middleware('auth');
Route::patch('/trazas/users/{user}', [App\Http\Controllers\TrazasController::class, 'updateUsers'])->name('traza_user.update')->middleware('auth');
Route::patch('/trazas/roles/{role}', [App\Http\Controllers\TrazasController::class, 'updateRoles'])->name('traza_roles.update')->middleware('auth');


// Módulo de Nomencladores
Route::get('/nomencladores', [NomencladoresController::class, 'index'])->name('nomencladores.index')->middleware('auth');
Route::get('/nomencladores/jerarquia', [NomencladoresController::class, 'indexJerarquia'])->name('jerarquia.index')->middleware('auth');
Route::get('/nomencladores/jerarquia/create', [NomencladoresController::class, 'createJerarquia'])->name('jerarquia.create')->middleware('auth');
Route::get('/nomencladores/jerarquia/{jerarquia}/edit', [NomencladoresController::class, 'editJerarquia'])->name('jerarquia.edit')->middleware('auth');
Route::get('/nomencladores/organismoSeguridad', [NomencladoresController::class, 'indexOrganismoSeguridad'])->name('organismoSeguridad.index')->middleware('auth');
Route::get('/nomencladores/organismoSeguridad/create', [NomencladoresController::class, 'createOrganismoSeguridad'])->name('organismoSeguridad.create')->middleware('auth');
Route::get('/nomencladores/organismoSeguridad/{organismo}/edit', [NomencladoresController::class, 'editOrganismoSeguridad'])->name('organismoSeguridad.edit')->middleware('auth');
Route::get('/nomencladores/estatusFuncionario', [NomencladoresController::class, 'indexEstatusFuncionario'])->name('estatusFuncionario.index')->middleware('auth');
Route::get('/nomencladores/estatusFuncionario/create', [NomencladoresController::class, 'createEstatusFuncionario'])->name('estatusFuncionario.create')->middleware('auth');
Route::get('/nomencladores/estatusFuncionario/{estatusFuncionario}/edit', [NomencladoresController::class, 'editEstatusFuncionario'])->name('estatusFuncionario.edit')->middleware('auth');
Route::patch('/nomencladores/jerarquia/{jerarquia}', [NomencladoresController::class, 'updateJerarquia'])->name('jerarquia.update')->middleware('auth');
Route::patch('/nomencladores/organismoSeguridad/{organismo}', [NomencladoresController::class, 'updateOrganismoSeguridad'])->name('organismoSeguridad.update')->middleware('auth');
Route::patch('/nomencladores/estatusFuncionario/{estatusFuncionario}', [NomencladoresController::class, 'updateEstatusFuncionario'])->name('estatusFuncionario.update')->middleware('auth');
Route::post('/nomencladores/jerarquia', [NomencladoresController::class, 'storeJerarquia'])->name('jerarquia.store')->middleware('auth');
Route::post('/nomencladores/organismoSeguridad', [NomencladoresController::class, 'storeOrganismoSeguridad'])->name('organismoSeguridad.store')->middleware('auth');
Route::post('/nomencladores/estatusFuncionario', [NomencladoresController::class, 'storeEstatusFuncionario'])->name('estatusFuncionario.store')->middleware('auth');
Route::delete('/nomencladores/jerarquia/{jerarquia}', [NomencladoresController::class, 'destroyJerarquia'])->name('jerarquia.destroy')->middleware('auth');
Route::delete('/nomencladores/organismoSeguridad/{organismo}', [NomencladoresController::class, 'destroyOrganismoSeguridad'])->name('organismoSeguridad.destroy')->middleware('auth');
Route::delete('/nomencladores/estatusFuncionario/{estatusFuncionario}', [NomencladoresController::class, 'destroyEstatusFuncionario'])->name('estatusFuncionario.destroy')->middleware('auth');


// Módulo de Configuraciones
Route::get('/configuraciones', [App\Http\Controllers\ConfiguracionesController::class, 'index'])->name('configuraciones.index')->middleware('auth');
Route::get('/configuraciones/permisos', [App\Http\Controllers\PermisosController::class, 'index'])->name('permisos.index')->middleware('auth');
Route::get('/configuraciones/permisos/create', [App\Http\Controllers\PermisosController::class, 'create'])->name('permisos.create')->middleware('auth');
Route::get('/configuraciones/permisos/{permiso}/edit', [PermisosController::class, 'edit'])->name('permisos.edit')->middleware('auth');
Route::get('/configuraciones/rutas/almacenamiento', [App\Http\Controllers\RutasAlmacenamientoController::class, 'index'])->name('rutasAlmacenamiento.index')->middleware('auth');
Route::get('/configuraciones/rutas/almacenamiento/create', [App\Http\Controllers\RutasAlmacenamientoController::class, 'create'])->name('rutasAlmacenamiento.create')->middleware('auth');
Route::get('/configuraciones/rutas/almacenamiento/{almacenamiento}/edit', [RutasAlmacenamientoController::class, 'edit'])->name('rutasAlmacenamiento.edit')->middleware('auth');
Route::patch('/configuraciones/permisos/{permiso}', [PermisosController::class, 'update'])->name('permisos.update')->middleware('auth');
Route::patch('/configuraciones/rutas/almacenamiento/{almacenamiento}', [RutasAlmacenamientoController::class, 'update'])->name('rutasAlmacenamiento.update')->middleware('auth');
Route::post('/configuraciones/permisos', [PermisosController::class, 'store'])->name('permisos.store')->middleware('auth');
Route::post('/configuraciones/rutas/almacenamiento', [RutasAlmacenamientoController::class, 'store'])->name('rutasAlmacenamiento.store')->middleware('auth');
Route::delete('/configuraciones/permisos/{permiso}', [PermisosController::class, 'destroy'])->name('permisos.destroy')->middleware('auth');
Route::delete('/configuraciones/rutas/almacenamiento/{almacenamiento}', [RutasAlmacenamientoController::class, 'destroy'])->name('rutasAlmacenamiento.destroy')->middleware('auth');

// Módulo de Logs
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs')->middleware('auth');


// Rutas de Autenticación
Auth::routes();


// Rutas Adicionales de Contraseña
Route::get('/password/forgot', [ForgotPasswordController::class, 'index'])->name('password.forgot');
Route::post('/password/mail', [ForgotPasswordController::class, 'sendMail'])->name('password.mail');
Route::post('/password/reset', [ResetPasswordController::class, 'index'])->name('password.reset');


// Rutas Adicionales de Logout
Route::get('logout/{id}', [LoginController::class, 'logout'])->middleware('auth');
Route::post('logout/{id}', [LoginController::class, 'logout'])->middleware('auth');

// Ruta para colocar buscador en tiempo real 
// Route::get('resenna/search/{cedula}', [ResennaController::class, 'search'])->name('resenna.search')->middleware('auth');

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
