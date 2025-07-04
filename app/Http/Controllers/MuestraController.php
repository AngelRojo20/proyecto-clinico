<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use App\Models\TipoMuestra;
use App\Models\Estado;
use App\Models\Paciente;
use App\Models\Tecnico;
use Illuminate\Http\Request;

class MuestraController extends Controller
{
    public function index()
    {
        $muestras = Muestra::with(['tipoMuestra', 'estado', 'paciente', 'tecnico'])->get();
        return view('muestras.index', compact('muestras'));
    }

    public function create()
    {
        $tipos = TipoMuestra::all();
        $estados = Estado::all();
        $pacientes = Paciente::all();
        $tecnicos = Tecnico::all();
        return view('muestras.create', compact('tipos', 'estados', 'pacientes', 'tecnicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:muestras',
            'tipo_muestra_id' => 'required|exists:tipo_muestras,id',
            'fecha_recoleccion' => 'required|date',
            'estado_id' => 'required|exists:estados,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'tecnico_id' => 'required|exists:tecnicos,id',
            'observaciones' => 'nullable|string',
        ]);

        Muestra::create($request->all());

        return redirect()->route('muestras.index')->with('success', 'Muestra creada correctamente.');
    }

    public function edit(Muestra $muestra)
    {
        $tipos = TipoMuestra::all();
        $estados = Estado::all();
        $pacientes = Paciente::all();
        $tecnicos = Tecnico::all();
        return view('muestras.edit', compact('muestra', 'tipos', 'estados', 'pacientes', 'tecnicos'));
    }

    public function update(Request $request, Muestra $muestra)
    {
        $request->validate([
            'codigo' => 'required|string|unique:muestras,codigo,' . $muestra->id,
            'tipo_muestra_id' => 'required|exists:tipo_muestras,id',
            'fecha_recoleccion' => 'required|date',
            'estado_id' => 'required|exists:estados,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'tecnico_id' => 'required|exists:tecnicos,id',
            'observaciones' => 'nullable|string',
        ]);

        $muestra->update($request->all());

        return redirect()->route('muestras.index')->with('success', 'Muestra actualizada correctamente.');
    }

    public function destroy(Muestra $muestra)
    {
        $muestra->delete();
        return redirect()->route('muestras.index')->with('success', 'Muestra eliminada.');
    }
}
