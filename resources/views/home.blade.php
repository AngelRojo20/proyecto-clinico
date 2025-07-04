@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h1 class="card-title text-center mb-4">Sistema de Registro de Muestras Biológicas</h1>
            <p class="card-text fs-5 text-justify">
                Esta aplicación permite gestionar de forma eficiente la recolección y trazabilidad de muestras biológicas
                como sangre, orina y otras. Podrás registrar pacientes, técnicos encargados del proceso, y mantener un control
                detallado de cada muestra recolectada, su estado y observaciones.
            </p>
            <div class="text-center mt-4">
                <a href="{{ route('muestras.index') }}" class="btn btn-primary me-2">Gestionar Muestras</a>
                <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary me-2">Ver Pacientes</a>
                <a href="{{ route('tecnicos.index') }}" class="btn btn-outline-secondary">Ver Técnicos</a>
            </div>
        </div>
    </div>
</div>
@endsection
