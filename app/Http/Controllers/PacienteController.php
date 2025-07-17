<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\TipoDocumento;
use App\Http\Requests\PacienteForm;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Pacientes\UpdateInterface;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\UseCases\Contracts\Pacientes\CreateInterface;
use App\UseCases\Contracts\Pacientes\ShowInterface;

class PacienteController extends Controller
{
    protected $pacienteRepository;

    public function __construct(PacienteRepositoryInterface $pacienteRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
    }

    public function index(Request $request)
    {
        $pacientes = $this->pacienteRepository->paginate(5);
        $tiposDocumento = TipoDocumento::all();

        if ($request->ajax()) {
            return view('pacientes.partials.table', compact('pacientes'))->render();
        }

        return view('pacientes.index', compact('pacientes', 'tiposDocumento'));
    }

    public function create()
    {
        $tiposDocumento = TipoDocumento::all();
        return view('pacientes.create', compact('tiposDocumento'));
    }

    public function store(PacienteForm $request, CreateInterface $createUseCase)
    {
        $paciente = $createUseCase->handle($request);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Paciente creado correctamente.',
                'paciente' => $paciente,
            ], 201);
        }

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente creado correctamente.');
    }

    public function edit(Paciente $paciente)
    {
        $tiposDocumento = TipoDocumento::all();
        return view('pacientes.edit', compact('paciente', 'tiposDocumento'));
    }

    public function show(Paciente $paciente, ShowInterface $showUseCase)
    {
        return response()->json($showUseCase->handle($paciente));
    }

    public function update(Request $request, Paciente $paciente, UpdateInterface $updateUseCase)
    {
        $updateUseCase->handle($request, $paciente);
        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Paciente eliminado correctamente.']);
        }

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
