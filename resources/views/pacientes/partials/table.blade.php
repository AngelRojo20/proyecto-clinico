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
        </tr>
    </thead>
    <tbody>
        @foreach($pacientes as $paciente)
            <tr class="fila-paciente" data-id="{{ $paciente->id }}">
                <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
                <td>{{ $paciente->tipoDocumento->nombre }}</td>
                <td>{{ $paciente->numero_documento }}</td>
                <td>{{ $paciente->fecha_nacimiento }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ $paciente->direccion }}</td>
                <td>{{ $paciente->telefono }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {!! $pacientes->links() !!}
</div>
