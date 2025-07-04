<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        $estados = ['Pendiente', 'Procesado', 'Rechazado', 'Archivado'];

        foreach ($estados as $estado) {
            Estado::create(['nombre' => $estado]);
        }
    }
}
