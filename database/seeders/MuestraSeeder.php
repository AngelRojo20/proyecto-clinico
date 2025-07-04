<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Muestra;

class MuestraSeeder extends Seeder
{
    public function run(): void
    {
        Muestra::create([
            'codigo' => 'MX001',
            'tipo_muestra_id' => 1,
            'fecha_recoleccion' => now(),
            'estado_id' => 1,
            'observaciones' => 'Muestra inicial',
            'paciente_id' => 1,
            'tecnico_id' => 1,
        ]);
    }
}
