<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;

Route::get('/', [PeliculaController::class, 'mostrarPeliculas'])->name('mostrar_peliculas');

Route::post('/guardar-pelicula', [PeliculaController::class, 'store'])->name('guardar_pelicula');
Route::post('/actualizar-pelicula', [PeliculaController::class, 'actualizar'])->name('actualizar_pelicula');

