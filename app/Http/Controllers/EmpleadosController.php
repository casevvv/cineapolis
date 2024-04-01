<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::all();
        $empleados = $empleados->map(function ($empleado) {
            return array_map('utf8_encode', $empleado->toArray());
        });
        if ($empleados->isEmpty()) {
            return response()->json(['message' => 'No hay empleados registrados.'], 200);
        } else {
            return response()->json($empleados, 200, [], JSON_UNESCAPED_UNICODE);
        }
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
        $data= $request->json()->all();
        if(empty($data)){
            return response()->json(['mesage'=>'No se encontraron datos'],404);
        }
        
        $request->validate([
            'nombres'=>'required|max:100',
            'apellidos'=>'required|max:100',
            'fechanac'=>'required|max:100',
            'correo'=>'required|max:100'
        ]);

        $emple=new Empleado();
        $emple->nombres=$data['nombres'];
        $emple->apellidos=$data['apellidos'];
        $emple->fechanac = $data['fechanac'];
        $emple->correo=$data['correo'];
        $emple->foto=$data['foto'];
        
        $emple->save();

        return response()->json(['message'=>'empleado ingresado correctamente'],202);
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
        //
    }
}
