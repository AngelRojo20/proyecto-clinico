<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoMuestra;

class TipoMuestraSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = ['Sangre', 'Orina', 'Saliva', 'Tejido'];

        foreach ($tipos as $tipo) {
            TipoMuestra::create(['nombre' => $tipo]);
        }
    }
}
