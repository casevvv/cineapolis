<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\historial_snack;
class historial_snackController extends Controller
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
            'id_snack' => 'required|max:100',
            'cantiad' => 'required|max:100',
            'precio' => 'required|max:100',
            'total' => 'required|max:100',
            'id_reserva' => 'required|max:100',
        ]);
    
        $acientos = new historial_snack();
        $acientos->id_snack = $data['id_snack'];
        $acientos->cantiad = $data['cantiad'];
        $acientos->precio= $data['precio'];
        $acientos->total = $data['total'];
        $acientos->id_reserva = $data['id_reserva'];
        $acientos->save();
        return response()->json(['message' => 'snack Guardado'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $historialSnack = historial_snack::where('id_reserva', $id)
        ->join('snack', 'historial_snack.id_snack', '=', 'snack.id')
        ->select(
            'historial_snack.*',
            'snack.combo'
        )
        ->get();

    if ($historialSnack->isEmpty()) {
        // Si no se encuentra ningún historial de snack para el id de reserva especificado, devolver un mensaje de error
        return response()->json(['message' => 'No se encontró historial de snack para la reserva especificada'], 404);
    }

    // Devolver los datos del historial de snack con el contenido del campo combo
    return response()->json($historialSnack, 200);
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
}
