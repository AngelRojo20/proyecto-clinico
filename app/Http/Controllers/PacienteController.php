<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\TipoDocumento;
use App\Http\Requests\PacienteForm;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Pacientes\UpdateInterface;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\UseCases\Contracts\Pacientes\CreateInterface;

class PacienteController extends Controller
{
    protected $pacienteRepository;

    public function __construct(PacienteRepositoryInterface $pacienteRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
    }

    public function index()
    {
        $pacientes = $this->pacienteRepository->all();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $tiposDocumento = TipoDocumento::all();
        return view('pacientes.create', compact('tiposDocumento'));
    }

    public function store(PacienteForm $request, CreateInterface $createUseCase)
    {
        $createUseCase->handle($request);
        return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente.');
    }

    public function edit(Paciente $paciente)
    {
        $tiposDocumento = TipoDocumento::all();
        return view('pacientes.edit', compact('paciente', 'tiposDocumento'));
    }

    public function update(Request $request, Paciente $paciente, UpdateInterface $updateUseCase)
    {
        $updateUseCase->handle($request, $paciente);
        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
