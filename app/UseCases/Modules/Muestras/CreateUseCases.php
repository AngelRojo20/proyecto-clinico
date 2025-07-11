<?php

namespace App\UseCases\Modules\Muestras;

use Illuminate\Http\Request;
use App\Models\Muestra;
use App\UseCases\Contracts\Muestras\CreateInterface;

class CreateUseCases implements CreateInterface
{
    public function handle(Request $request): Muestra
    {
        return Muestra::create([
            'codigo' => $request->codigo,
            'tipo_muestra_id' => $request->tipo_muestra_id,
            'fecha_recoleccion' => $request->fecha_recoleccion,
            'estado_id' => $request->estado_id,
            'paciente_id' => $request->paciente_id,
            'tecnico_id' => $request->tecnico_id,
            'observaciones' => $request->observaciones,
        ]);
    }
}
