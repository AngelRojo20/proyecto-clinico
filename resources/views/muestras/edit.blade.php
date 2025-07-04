@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Editar Muestra</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('muestras.update', $muestra) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $muestra->codigo }}" required>
    </div>

    <div class="mb-3">
        <label for="tipo_muestra_id" class="form-label">Tipo de Muestra</label>
        <select name="tipo_muestra_id" id="tipo_muestra_id" class="form-select" required>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id }}" {{ $muestra->tipo_muestra_id == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha_recoleccion" class="form-label">Fecha de Recolección</label>
        <input type="date" name="fecha_recoleccion" id="fecha_recoleccion" class="form-control" value="{{ $muestra->fecha_recoleccion }}" required>
    </div>

    <div class="mb-3">
        <label for="estado_id" class="form-label">Estado</label>
        <select name="estado_id" id="estado_id" class="form-select" required>
            @foreach($estados as $estado)
                <option value="{{ $estado->id }}" {{ $muestra->estado_id == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="paciente_id" class="form-label">Paciente</label>
        <select name="paciente_id" id="paciente_id" class="form-select" required>
            @foreach($pacientes as $paciente)
                <option value="{{ $paciente->id }}" {{ $muestra->paciente_id == $paciente->id ? 'selected' : '' }}>
                    {{ $paciente->nombres }} {{ $paciente->apellidos }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tecnico_id" class="form-label">Técnico</label>
        <select name="tecnico_id" id="tecnico_id" class="form-select" required>
            @foreach($tecnicos as $tecnico)
                <option value="{{ $tecnico->id }}" {{ $muestra->tecnico_id == $tecnico->id ? 'selected' : '' }}>
                    {{ $tecnico->nombres }} {{ $tecnico->apellidos }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea name="observaciones" id="observaciones" class="form-control">{{ $muestra->observaciones }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('muestras.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
</div>
@endsection
