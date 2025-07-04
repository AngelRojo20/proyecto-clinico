<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Cédula', 'abreviatura' => 'CC'],
            ['nombre' => 'Pasaporte', 'abreviatura' => 'PA'],
            ['nombre' => 'Tarjeta de Identidad', 'abreviatura' => 'TI'],
        ];

        foreach ($tipos as $tipo) {
            TipoDocumento::create($tipo);
        }
    }
}
