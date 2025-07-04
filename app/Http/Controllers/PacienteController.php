<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('tipoDocumento')->get();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $tiposDocumento = TipoDocumento::all();
        return view('pacientes.create', compact('tiposDocumento'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:50|unique:pacientes',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'sexo' => 'required|in:M,F',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
        ]);

        $paciente = Paciente::create([
            'tipo_documento_id' => $request->tipo_documento_id,
            'numero_documento' => $request->numero_documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente.');
    }

    public function edit(Paciente $paciente)
    {
        $tiposDocumento = TipoDocumento::all();
        return view('pacientes.edit', compact('paciente', 'tiposDocumento'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $rules= [];
        if ($request->has('nombres')) {
            $rules['nombres'] = 'string|max:255|regex:/^[\pL\s\-]+$/u';
        }

        if ($request->has('apellidos')) {
            $rules['apellidos'] = 'string|max:255|regex:/^[\pL\s\-]+$/u';
        }

        if ($request->has('tipo_documento_id')) {
            $rules['tipo_documento_id'] = 'exists:tipo_documentos,id';
        }

        if ($request->has('numero_documento')) {
            $rules['numero_documento'] = 'string|max:50|unique:pacientes,numero_documento,' . $paciente->id;
        }

        if ($request->has('fecha_nacimiento')) {
            $rules['fecha_nacimiento'] = 'date|before:today';
        }

        if ($request->has('sexo')) {
            $rules['sexo'] = 'in:M,F';
        }

        if ($request->has('direccion')) {
            $rules['direccion'] = 'string|max:255';
        }

        if ($request->has('telefono')) {
            $rules['telefono'] = 'string|max:50';
        }

        $validated = $request->validate($rules);

        $paciente->update($validated);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
