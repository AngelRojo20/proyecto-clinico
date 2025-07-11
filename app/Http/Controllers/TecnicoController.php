<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use App\Http\Requests\TecnicoForm;
use App\UseCases\Contracts\Tecnicos\CreateInterface;
use App\Http\Requests\TecnicoUpdateForm;
use App\UseCases\Contracts\Tecnicos\UpdateInterface;

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

    public function store(TecnicoForm $request, CreateInterface $createUseCase)
    {
        $createUseCase->handle($request);
        return redirect()->route('tecnicos.index')->with('success', 'Técnico creado correctamente.');
    }

    public function edit(Tecnico $tecnico)
    {
        $tiposDocumento = TipoDocumento::all();
        return view('tecnicos.edit', compact('tecnico', 'tiposDocumento'));
    }

    public function update(TecnicoUpdateForm $request, Tecnico $tecnico, UpdateInterface $updateUseCase)
    {
        $updateUseCase->handle($request, $tecnico);
        return redirect()->route('tecnicos.index')->with('success', 'Técnico actualizado correctamente.');
    }

    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();
        return redirect()->route('tecnicos.index')->with('success', 'Técnico eliminado correctamente.');
    }
}
