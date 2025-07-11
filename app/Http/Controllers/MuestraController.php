<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use App\Models\TipoMuestra;
use App\Models\Estado;
use App\Models\Paciente;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use App\Http\Requests\MuestraForm;
use App\UseCases\Contracts\Muestras\CreateInterface;
use App\Http\Requests\MuestraUpdateForm;
use App\UseCases\Contracts\Muestras\UpdateInterface;

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

    public function store(MuestraForm $request, CreateInterface $createUseCase)
    {
        $createUseCase->handle($request);
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

    public function update(MuestraUpdateForm $request, Muestra $muestra, UpdateInterface $updateUseCase)
    {
        $updateUseCase->handle($request, $muestra);
        return redirect()->route('muestras.index')->with('success', 'Muestra actualizada correctamente.');
    }

    public function destroy(Muestra $muestra)
    {
        $muestra->delete();
        return redirect()->route('muestras.index')->with('success', 'Muestra eliminada.');
    }
}
