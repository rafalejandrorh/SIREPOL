<?php

use App\Http\Controllers\Services\AuthServicesController;
use App\Http\Controllers\Services\FuncionarioServicesController;
use App\Http\Controllers\Services\ResennaServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/Login/{user}/{password}', [AuthServicesController::class, 'login'])->name('login');

Route::post('/Logout', [AuthServicesController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::get('/ConsultaFuncionario/{tipo}/{valor}', [FuncionarioServicesController::class, 'SearchFuncionario'])->name('ConsultaFuncionario')->middleware('auth:sanctum');//['auth:sanctum', 'abilities:Funcionario:Consultar']

Route::get('/ConsultaResennado/{cedula}', [ResennaServicesController::class, 'SearchResennado'])->name('ConsultaResennado')->middleware('auth:sanctum');

