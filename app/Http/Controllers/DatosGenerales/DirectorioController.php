<?php

namespace App\Http\Controllers\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Directorios;

class DirectorioController extends Controller
{

    // Método para mostrar la lista
    public function index(Request $request)
    {
         // Obtener el término de búsqueda ingresado
    $search = $request->input('search');

    // Crear la consulta para buscar en todos los campos relevantes
    $directorios = Directorios::where('nombre', 'like', '%' . $search . '%')
        ->orWhere('cargo', 'like', '%' . $search . '%')
        ->orWhere('apellidos', 'like', '%' . $search . '%')
        ->orWhere('correo', 'like', '%' . $search . '%')      
        ->paginate(12); 
        $titulo = "Lista de Directorios";
    return view('directorio.listar', compact('directorios','titulo'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        return view('directorio.crear');
    }

    // Método para almacenar un nuevo directorio
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_categoria' => 'required|integer',
            'foto' => 'required|string',
            'cargo' => 'required|string',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'correo' => 'required|email',
            'telefono' => 'required|string',
        ]);

        Directorios::create($data);

        return redirect()->route('datos-generales.directorio.index');
    }

    // Método para mostrar el formulario de edición
    public function edit(Directorios $directorio)
    {
        return view('directorio.editar', compact('directorio'));
    }

    // Método para actualizar un directorio existente
    public function update(Request $request, Directorios $directorio)
    {
        $data = $request->validate([
            'id_categoria' => 'required|integer',
            'foto' => 'required|string',
            'cargo' => 'required|string',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'correo' => 'required|email',
            'telefono' => 'required|string',
        ]);

        $directorio->update($data);

        return redirect()->route('datos-generales.directorio.index');
    }
}
