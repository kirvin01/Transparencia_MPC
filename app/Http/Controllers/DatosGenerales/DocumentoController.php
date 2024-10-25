<?php

namespace App\Http\Controllers\DatosGenerales;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\TipoDocumento;
use App\Models\EstadoDocumento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
       // dd($tipos);
        return view('documentos.crud.index', compact('documentos', 'tipos', 'estados'));
    }

    public function create()
    {
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        return view('documentos.crud.create', compact('tipos', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idtipo_documento' => 'required',
            'numero' => 'required|string|max:100',
            'fecha' => 'required|date',
            'fechapubli' => 'required|date',
            'sumilla' => 'required|string|max:800',
            'url' => 'required|url',
            'idestado' => 'required',
            'html' => 'required',
            'titulo' => 'required|string',
        ]);

        Documento::create($request->all());
        return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento creado exitosamente.');
    }

    public function edit(Documento $documento)
    {
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        return view('documentos.crud.edit', compact('documento', 'tipos', 'estados'));
    }

    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'idtipo_documento' => 'required',
            'numero' => 'required|string|max:100',
            'fecha' => 'required|date',
            'fechapubli' => 'required|date',
            'sumilla' => 'required|string|max:800',
            'url' => 'required|url',
            'idestado' => 'required',
            'html' => 'required',
            'titulo' => 'required|string',
        ]);

        $documento->update($request->all());
        return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento actualizado exitosamente.');
    }

    public function destroy(Documento $documento)
    {
        $documento->delete();
        return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento eliminado exitosamente.');
    }
}
