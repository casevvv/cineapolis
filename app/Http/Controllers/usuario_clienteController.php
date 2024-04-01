<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario_cliente;
class usuario_clienteController extends Controller
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
        'correo' => 'required|max:100',
        'estado' => 'required|max:100',
    ]);

    $usuario = new usuario_cliente();
    $usuario->correo = $data['correo']; // Asigna el valor del correo electrónico
    $usuario->estado = $data['estado']; // Asigna el valor del estado
    
    
    $usuario->save();

    return response()->json(['message' => 'Registro Exitoso'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        
    }
    public function verPorCorreo($correo)
    {
        if ($correo === null) {
            return response()->json(['mensaje' => 'Correo no especificado'], 400);
        }
    
        // Busca el usuario por su correo electrónico
        $usuario = usuario_cliente::where('correo', $correo)->first();
    
        if ($usuario) {
            // Si se encuentra el usuario, devuelve una respuesta con los datos del usuario
            return response()->json($usuario, 200);
        } else {
            // Si no se encuentra el usuario, devuelve una respuesta indicando que no se encontró
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
    }
}
