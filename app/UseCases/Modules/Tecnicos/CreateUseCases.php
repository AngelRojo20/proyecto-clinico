<?php

namespace App\UseCases\Modules\Tecnicos;

use Illuminate\Http\Request;
use App\Models\Tecnico;
use App\UseCases\Contracts\Tecnicos\CreateInterface;

class CreateUseCases implements CreateInterface
{
    public function handle(Request $request): Tecnico
    {
        return Tecnico::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'tipo_documento_id' => $request->tipo_documento_id,
            'numero_documento' => $request->numero_documento,
        ]);
    }
}
