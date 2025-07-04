<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function index()
    {
        $tecnicos = Tecnico::with('tipoDocumento')->get();
        return view('tecnicos.index', compact('tecnicos'));
    }

    public function create()
    {
        $tiposDocumento = TipoDocumento::all();
        return view('tecnicos.create', compact('tiposDocumento'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:50|unique:tecnicos',
        ]);

        Tecnico::create($request->all());

        return redirect()->route('tecnicos.index')->with('success', 'Técnico creado correctamente.');
    }

    public function edit(Tecnico $tecnico)
    {
        $tiposDocumento = TipoDocumento::all();
        return view('tecnicos.edit', compact('tecnico', 'tiposDocumento'));
    }

    public function update(Request $request, Tecnico $tecnico)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:50|unique:tecnicos,numero_documento,' . $tecnico->id,
        ]);

        $tecnico->update($request->all());

        return redirect()->route('tecnicos.index')->with('success', 'Técnico actualizado correctamente.');
    }

    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();
        return redirect()->route('tecnicos.index')->with('success', 'Técnico eliminado correctamente.');
    }
}
