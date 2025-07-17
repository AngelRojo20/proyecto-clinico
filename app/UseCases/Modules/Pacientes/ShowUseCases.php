<?php

namespace App\UseCases\Modules\Pacientes;

use App\Models\Paciente;
use App\UseCases\Contracts\Pacientes\ShowInterface;

class ShowUseCases implements ShowInterface
{
    public function handle(Paciente $paciente): array
    {
        return [
            'id' => $paciente->id,
            'nombres' => $paciente->nombres,
            'apellidos' => $paciente->apellidos,
            'tipo_documento_id' => $paciente->tipo_documento_id,
            'numero_documento' => $paciente->numero_documento,
            'fecha_nacimiento' => $paciente->fecha_nacimiento,
            'sexo' => $paciente->sexo,
            'direccion' => $paciente->direccion,
            'telefono' => $paciente->telefono,
        ];
    }
}
