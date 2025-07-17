@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pacientes</h1>
    <x-snackbar />


    {{-- Formulario para crear paciente --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Crear nuevo paciente</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="mensaje"></div>

            @include('pacientes.partials.form-create')
        </div>
    </div>

    {{-- Tabla de pacientes --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="pacientes-content">
        @include('pacientes.partials.table')
    </div>

</div>
@endsection
