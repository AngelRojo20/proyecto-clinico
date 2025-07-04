@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Muestras</h1>

    <a href="{{ route('muestras.create') }}" class="btn btn-primary mb-3">Registrar nueva muestra</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo de Muestra</th>
                <th>Fecha de Recolección</th>
                <th>Estado</th>
                <th>Paciente</th>
                <th>Técnico</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($muestras as $muestra)
                <tr>
                    <td>{{ $muestra->codigo }}</td>
                    <td>{{ $muestra->tipoMuestra->nombre }}</td>
                    <td>{{ $muestra->fecha_recoleccion }}</td>
                    <td>{{ $muestra->estado->nombre }}</td>
                    <td>{{ $muestra->paciente->nombres }} {{ $muestra->paciente->apellidos }}</td>
                    <td>{{ $muestra->tecnico->nombres }} {{ $muestra->tecnico->apellidos }}</td>
                    <td>{{ $muestra->observaciones }}</td>
                    <td>
                        <a href="{{ route('muestras.edit', $muestra) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('muestras.destroy', $muestra) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar muestra?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
