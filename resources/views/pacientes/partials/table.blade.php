<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre completo</th>
            <th>Tipo documento</th>
            <th>Número documento</th>
            <th>Fecha de nacimiento</th>
            <th>Sexo</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                <td>{{ $paciente->tipoDocumento->nombre }}</td>
                <td>{{ $paciente->numero_documento }}</td>
                <td>{{ $paciente->fecha_nacimiento }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ $paciente->direccion }}</td>
                <td>{{ $paciente->telefono }}</td>
                <td>
                    <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro?')" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {!! $pacientes->links() !!}
</div>
