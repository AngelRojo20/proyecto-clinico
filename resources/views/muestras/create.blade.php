@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Registrar Muestra</h1>
    <form action="{{ route('muestras.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="mb-3">
            <label for="tipo_muestra_id" class="form-label">Tipo de Muestra</label>
            <select class="form-select" id="tipo_muestra_id" name="tipo_muestra_id" required>
                <option value="">Seleccione</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_recoleccion" class="form-label">Fecha de Recolección</label>
            <input type="date" class="form-control" id="fecha_recoleccion" name="fecha_recoleccion" required>
        </div>
        <div class="mb-3">
            <label for="estado_id" class="form-label">Estado</label>
            <select class="form-select" id="estado_id" name="estado_id" required>
                <option value="">Seleccione</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select class="form-select" id="paciente_id" name="paciente_id" required>
                <option value="">Seleccione</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nombres }} {{ $paciente->apellidos }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tecnico_id" class="form-label">Técnico</label>
            <select class="form-select" id="tecnico_id" name="tecnico_id" required>
                <option value="">Seleccione</option>
                @foreach($tecnicos as $tecnico)
                    <option value="{{ $tecnico->id }}">{{ $tecnico->nombres }} {{ $tecnico->apellidos }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Muestra</button>
        <a href="{{ route('muestras.index') }}" class="btn btn-secondary">Cancelar</a>


    </form>
</div>
@endsection
