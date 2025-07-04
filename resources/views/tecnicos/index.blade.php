@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Técnicos</h1>
    <a href="{{ route('tecnicos.create') }}" class="btn btn-primary mb-3">Crear Técnico</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Tipo Documento</th>
                <th>Número Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tecnicos as $tecnico)
                <tr>
                    <td>{{ $tecnico->nombres }}</td>
                    <td>{{ $tecnico->apellidos }}</td>
                    <td>{{ $tecnico->tipoDocumento->nombre }}</td>
                    <td>{{ $tecnico->numero_documento }}</td>
                    <td>
                        <a href="{{ route('tecnicos.edit', $tecnico) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('tecnicos.destroy', $tecnico) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar técnico?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
