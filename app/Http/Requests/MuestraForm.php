<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuestraForm extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => 'required|string|unique:muestras',
            'tipo_muestra_id' => 'required|exists:tipo_muestras,id',
            'fecha_recoleccion' => 'required|date',
            'estado_id' => 'required|exists:estados,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'tecnico_id' => 'required|exists:tecnicos,id',
            'observaciones' => 'nullable|string',
        ];
    }
}
