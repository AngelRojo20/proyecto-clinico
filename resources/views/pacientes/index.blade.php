@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pacientes</h1>

    <a href="{{ route('pacientes.create') }}" class="btn btn-primary mb-3">Crear nuevo paciente</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="pacientes-content">
        @include('pacientes.partials.table')
    </div>

</div>
@endsection
