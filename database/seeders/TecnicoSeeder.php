<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tecnico;

class TecnicoSeeder extends Seeder
{
    public function run(): void
    {
        Tecnico::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'tipo_documento_id' => 1,
            'numero_documento' => '123456789',
        ]);

        Tecnico::create([
            'nombres' => 'Laura',
            'apellidos' => 'Gómez',
            'tipo_documento_id' => 2,
            'numero_documento' => 'A987654321',
        ]);
    }
}
