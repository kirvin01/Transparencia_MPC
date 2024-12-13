<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TipoDocumento;
use App\Models\Documento;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function getTiposDocumentos()
    {
        $tipos = TipoDocumento::all();
        return response()->json($tipos);
    }

    public function getDocumentos(Request $request)
    {
        $documentos = Documento::with('tipoDocumento')->paginate(9);
        return response()->json($documentos);


        

       
    
        return view('documentos.index', compact('documentos'));
    }
    
   public function searchDocumentos(Request $request)
{
    try {
        $query = Documento::with('tipoDocumento');

        if ($request->filled('tipo_documento')) {
            $query->where('idtipo_documento', $request->tipo_documento);
        }

        if ($request->filled('numero')) {
            $query->where('numero', 'LIKE', '%' . $request->numero . '%');
        }

        if ($request->filled('anio')) {
            $query->whereYear('fecha', $request->anio);
        }

        if ($request->filled('sumilla') && !empty($request->sumilla)) {
            $query->where('sumilla', 'LIKE', '%' . $request->sumilla . '%');
        }

        $documentos = $query->paginate(10);
        return response()->json($documentos);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ], 500);
    }
}
}
