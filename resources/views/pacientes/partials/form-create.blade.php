<form action="{{ route('pacientes.store') }}" id="form-create-paciente" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres">
            <div class="invalid-feedback d-block" id="error-nombres"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos">
            <div class="invalid-feedback d-block" id="error-apellidos"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="tipo_documento_id" class="form-label">Tipo de Documento</label>
            <select class="form-select" id="tipo_documento_id" name="tipo_documento_id">
                <option value="">Seleccione...</option>
                @foreach($tiposDocumento as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback d-block" id="error-tipo_documento_id"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="numero_documento" class="form-label">Número de Documento</label>
            <input type="text" class="form-control" id="numero_documento" name="numero_documento">
            <div class="invalid-feedback d-block" id="error-numero_documento"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            <div class="invalid-feedback d-block" id="error-fecha_nacimiento"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-select" id="sexo" name="sexo">
                <option value="">Seleccione...</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <div class="invalid-feedback d-block" id="error-sexo"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
            <div class="invalid-feedback d-block" id="error-direccion"></div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
            <div class="invalid-feedback d-block" id="error-telefono"></div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-3 justify-content-center">
        <x-form-buttons />
    </div>
</form>
