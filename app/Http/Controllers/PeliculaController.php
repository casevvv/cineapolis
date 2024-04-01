<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Pelicula;

class PeliculaController extends Controller
{

    public function mostrarPeliculasPorEstado($estado)
    {
        // Filtrar las películas donde el estado sea igual al estado proporcionado
        $peliculas = Pelicula::where('estado', $estado)->get();

        return response()->json($peliculas);
    }

    public function mostrarPeliculas()
    {
        $peliculas = Pelicula::all();

        return view('peliculas')->with('peliculas', $peliculas); 
    }



    // Función para guardar una nueva película
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'sala' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
            'estado' => 'required', // Corrección: Validación para la hora de inicio
        ]);

        $imagen_base64 = base64_encode(file_get_contents($request->imagen->path()));

        Pelicula::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'sala' => $request->sala,
            'imagen' => $imagen_base64,
            'estado' => $request->estado, // Corrección: Usar 'hora_inicio' en lugar de 'hora'
        ]);

        return response()->json(['message' => 'Película guardada correctamente']);
    }
    
    //edit

public function actualizar(Request $request)
{
    // Validación de datos
    $request->validate([
        'nombreedit' => 'required|string|max:255',
        'descripcionedit' => 'nullable|string',
        'salaedit' => 'required|integer',
        'estadoedit' => 'required|boolean',
        'imagenedit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Obtener la película basada en el ID enviado desde el formulario
    $pelicula = Pelicula::findOrFail($request->idedit);

    // Actualizar los campos de la película con los datos del formulario
    $pelicula->nombre = $request->nombreedit;
    $pelicula->descripcion = $request->descripcionedit;
    $pelicula->sala = $request->salaedit;
    $pelicula->estado = $request->estadoedit;

    // Manejo de la imagen si se envió una nueva
    if ($request->hasFile('imagenedit')) {
        // Obtener el archivo de imagen del formulario
        $imagen = $request->file('imagenedit');
        // Leer el contenido del archivo
        $imagenBinaria = file_get_contents($imagen->getPathName());
        // Actualizar el campo de imagen en la película con los nuevos datos binarios de la imagen
        $pelicula->imagen = $imagenBinaria;
    }

    // Guardar los cambios en la base de datos
    $pelicula->save();

    // Redireccionar o devolver una respuesta según sea necesario
    return response()->json(['message' => 'La película ha sido actualizada correctamente']);

}
}
