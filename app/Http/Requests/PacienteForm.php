<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { //Puedo hacer uso de logica en este espacio.
        return [
            'nombres' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required|string|max:50|unique:pacientes',
            'fecha_nacimiento' => 'required|date|before:today',
            'sexo' => 'required|in:M,F',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
        ];
    }
}
