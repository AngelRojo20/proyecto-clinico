@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Técnico</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tecnicos.update', $tecnico) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $tecnico->nombres }}" required>
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $tecnico->apellidos }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_documento_id" class="form-label">Tipo de Documento</label>
            <select name="tipo_documento_id" id="tipo_documento_id" class="form-select" required>
                @foreach($tiposDocumento as $tipo)
                    <option value="{{ $tipo->id }}" {{ $tecnico->tipo_documento_id == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="numero_documento" class="form-label">Número de Documento</label>
            <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{ $tecnico->numero_documento }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tecnicos.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>
</div>
@endsection
