<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\acientos;

class acientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
            'id_pelicula' => 'required|max:100',
            'aciento' => 'required|max:100',
            'ciudad' => 'required|max:100',
            'fecha' => 'required|max:100',
            'hora' => 'required|max:100',
            'id_reserva' => 'required|max:100',
        ]);
    
        $acientos = new acientos();
        $acientos->id_pelicula = $data['id_pelicula'];
        $acientos->aciento = $data['aciento'];
        $acientos->ciudad = $data['ciudad'];
        $acientos->fecha = $data['fecha'];
        $acientos->hora = $data['hora'];
        $acientos->id_reserva = $data['id_reserva'];  
        $acientos->save();
        return response()->json(['message' => 'Aciento Guardado'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            $countAsientos = acientos::where('id_reserva', $id)->count();

            // Obtener la ciudad única asociada a la reserva
            $ciudad = acientos::where('id_reserva', $id)->first()->ciudad;
        
            // Devolver el número de asientos y la ciudad única
            return response()->json(['count' => $countAsientos, 'ciudad' => $ciudad]);
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
    public function obtenerAsientos(Request $request)
    {
        // Validar los datos recibidos
      // Obtener los asientos según los parámetros
$asientos = acientos::where('id_pelicula', $request->id_pelicula)
->where('ciudad', $request->ciudad)
->where('fecha', $request->fecha)
->where('hora', $request->hora)
->get(['aciento']);

// Ordenar los asientos de manera personalizada
$asientos = $asientos->sortByDesc(function ($asiento) {
// Extraer la letra y el número del asiento
preg_match('/([A-Za-z]+)(\d+)/', $asiento->aciento, $matches);
$letra = strtoupper($matches[1]); // Convertir la letra a mayúsculas
$numero = (int) $matches[2]; // Convertir el número a entero
return [$letra, $numero];
})->values(); // Reindexar los resultados

// Devolver los asientos encontrados
return response()->json($asientos);

    }
}

