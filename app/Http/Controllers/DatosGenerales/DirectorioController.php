<?php

namespace App\Http\Controllers\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Directorios;
use App\Models\Categoria;

class DirectorioController extends Controller
{
    // Método para mostrar la lista
    public function index(Request $request)
    {
        $search = $request->input('search');
        $directorios = Directorios::where('nombre', 'like', '%' . $search . '%')
            ->orWhere('cargo', 'like', '%' . $search . '%')
            ->orWhere('apellidos', 'like', '%' . $search . '%')
            ->orWhere('correo', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $titulo = "Lista de Directorios";
        return view('directorio.listar', compact('directorios', 'titulo'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('directorio._form', compact('categorias'));
        // return view('directorio._form');
    }

    // Método para almacenar un nuevo directorio
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_categoria' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Cambiado a 'nullable'
            'cargo' => 'required|string',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'correo' => 'required|email',
            'telefono' => 'required|string',
        ]);

        // Manejar la subida de la foto, si existe
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('directorios', 'public');
            $data['foto'] = $path;
        } else {
            // Si no se sube foto, podrías establecer un valor por defecto, o dejarlo vacío
            $data['foto'] = null; // O una ruta por defecto, como 'default.jpg'
        }

        Directorios::create($data);

        return redirect()->route('datos-generales.directorio.index')->with('success', 'Directorio creado exitosamente.');
    }

    // Método para mostrar el formulario de edición
    public function edit(Directorios $directorio)
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('directorio._form', compact('directorio', 'categorias'));
       // return view('directorio._form', compact('directorio'));
    }

    public function update(Request $request, Directorios $directorio)
    {
        $data = $request->validate([
            'id_categoria' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Cambiado a 'nullable'
            'cargo' => 'required|string',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'correo' => 'required|email',
            'telefono' => 'required|string',
        ]);

        // Manejar la subida de una nueva foto, si existe
        if ($request->hasFile('foto')) {
            if ($directorio->foto) {
                Storage::delete('public/' . $directorio->foto);
            }
            $file = $request->file('foto');
            $path = $file->store('directorios', 'public');
            $data['foto'] = $path;
        }

        $directorio->update($data);

        return redirect()->route('datos-generales.directorio.index')->with('success', 'Directorio actualizado exitosamente.');
    }

    // Método para eliminar un directorio
    public function destroy(Directorios $directorio)
    {
        if ($directorio->foto) {
            Storage::delete('public/' . $directorio->foto);
        }

        $directorio->delete();

        return redirect()->route('datos-generales.directorio.index')->with('success', 'Directorio eliminado exitosamente.');
    }
}
