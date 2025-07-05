<?php

namespace App\UseCases\Modules\Pacientes;
use App\UseCases\Contracts\Pacientes\UpdateInterface;
use App\Models\Paciente;
use Illuminate\Http\Request;

class UpdateUseCases implements UpdateInterface
{
    public function handle(Request $request, Paciente $paciente): Paciente
    {
        $rules= [];
        if ($request->has('nombres')) {
            $rules['nombres'] = 'string|max:255|regex:/^[\pL\s\-]+$/u';
        }

        if ($request->has('apellidos')) {
            $rules['apellidos'] = 'string|max:255|regex:/^[\pL\s\-]+$/u';
        }

        if ($request->has('tipo_documento_id')) {
            $rules['tipo_documento_id'] = 'exists:tipo_documentos,id';
        }

        if ($request->has('numero_documento')) {
            $rules['numero_documento'] = 'string|max:50|unique:pacientes,numero_documento,' . $paciente->id;
        }

        if ($request->has('fecha_nacimiento')) {
            $rules['fecha_nacimiento'] = 'date|before:today';
        }

        if ($request->has('sexo')) {
            $rules['sexo'] = 'in:M,F';
        }

        if ($request->has('direccion')) {
            $rules['direccion'] = 'string|max:255';
        }

        if ($request->has('telefono')) {
            $rules['telefono'] = 'string|max:50';
        }

        $validated = $request->validate($rules);

        $paciente->update($validated);
        return $paciente;
    }
}
