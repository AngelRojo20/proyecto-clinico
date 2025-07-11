<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TecnicoUpdateForm extends FormRequest
{
    /**
     * Autoriza la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar un técnico.
     */
    public function rules(): array
    {
        return [
            'nombres' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tecnicos', 'numero_documento')->ignore($this->route('tecnico')->id),
            ],
        ];
    }
}
