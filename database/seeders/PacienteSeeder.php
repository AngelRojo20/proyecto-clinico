<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        Paciente::create([
            'nombres' => 'Carlos',
            'apellidos' => 'García',
            'tipo_documento_id' => 1,
            'numero_documento' => '11223344',
            'fecha_nacimiento' => '1990-05-15',
            'sexo' => 'M',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '555-1234',
        ]);
    }
}
