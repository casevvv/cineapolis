<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\acientosController;
use App\Http\Controllers\usuario_clienteController;
use App\Http\Controllers\historial_reservaController;
use App\Http\Controllers\historial_snackController;
use App\Http\Controllers\PeliculaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/acientos', [acientosController::class, 'obtenerAsientos'])->name('acientosController.obtener');
Route::get('/usuarios/{correo}', [usuario_clienteController::class, 'verPorCorreo']);
Route::post('/usuarios/store',[usuario_clienteController::class,'store']);
Route::post('/historial/store',[historial_reservaController::class,'store']);
Route::get('historial/{id_usuario}', [historial_reservaController::class, 'show']);
Route::post('/acientos/store',[acientosController::class,'store']);
Route::get('acientos/{id}', [acientosController::class, 'show']);
Route::post('/snack/store',[historial_snackController::class,'store']);
Route::get('snack/{id}', [historial_snackController::class, 'show']);
Route::get('historial/{id_usuario}/ultimo_id', [historial_reservaController::class, 'ultimoIdHistorial']);
Route::get('/peliculas/estado/{estado}', [PeliculaController::class, 'mostrarPeliculasPorEstado']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
