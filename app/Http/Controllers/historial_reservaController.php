<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\historial_reserva;

class historial_reservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
    if (empty($data)) {
        return response()->json(['message' => 'No se encontraron datos'], 404);
    }
    
    $request->validate([
        'id_usuario' => 'required|max:100',
        'fecha' => 'required|max:100',
        'hora' => 'required|max:100',
        'total' => 'required|max:100',
        'id_pelicula' => 'required|max:100',
    ]);

    $historial = new historial_reserva();
    $historial->id_usuario = $data['id_usuario'];
    $historial->fecha = $data['fecha'];
    $historial->hora = $data['hora'];
    $historial->total = $data['total'];
    $historial->id_pelicula = $data['id_pelicula'];  
    
    
    $historial->save();

    return response()->json(['message' => 'Historial Guardado'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_usuario)
    {
        $historial = historial_reserva::where('id_usuario', $id_usuario)
        ->join('peliculas', 'historial_reserva.id_pelicula', '=', 'peliculas.id')
        ->select(
            'historial_reserva.id',
            historial_reserva::raw("DATE_FORMAT(historial_reserva.fecha, '%d-%m-%Y') AS fecha"),
            'historial_reserva.hora',
            'historial_reserva.total',
            'peliculas.nombre as nombre_pelicula',
            'peliculas.imagen as imagen_pelicula',
            'peliculas.sala as nombre_sala' // Suponiendo que el campo de sala está en la tabla de peliculas
        )
        ->orderBy('historial_reserva.fecha', 'desc')
        ->get();

    if ($historial->isEmpty()) {
        // Si no se encuentra ningún historial para el usuario especificado, devolver un mensaje de error
        return response()->json(['message' => 'No se encontró historial para el usuario especificado'], 404);
    }

    // Devolver los datos del historial de reserva con el nombre de la película y la sala
    return response()->json($historial, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function ultimoIdHistorial($id_usuario){
    // Buscar el último historial de reserva para el id_usuario especificado
    $ultimo_historial = historial_reserva::where('id_usuario', $id_usuario)
        ->orderBy('id', 'desc')
        ->first();

    if (!$ultimo_historial) {
        // Si no se encuentra ningún historial para el usuario especificado, devolver un mensaje de error
        return response()->json(['message' => 'No se encontró historial para el usuario especificado'], 404);
    }

    // Devolver el ID del último historial de reserva encontrado con el nombre "ultimo_id_historial"
    return response()->json(['ultimo_id_historial' => $ultimo_historial->id], 200);}
}
