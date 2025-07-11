<?php

namespace App\UseCases\Modules\Pacientes;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Pacientes\CreateInterface;

class CreateUseCases implements CreateInterface
{
    public function handle(Request $request): Paciente
    {
        return Paciente::create([
            'tipo_documento_id' => $request->tipo_documento_id,
            'numero_documento' => $request->numero_documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);
    }
}
