<?php

namespace Database\Seeders;

use App\Models\User;
Use App\Models\TipoDocumento;
use App\Models\TipoMuestra;
use App\Models\Estado;
use App\Models\Tecnico;
use App\Models\Paciente;
use App\Models\Muestra;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        $this->call([
            TipoDocumentoSeeder::class,
            TipoMuestraSeeder::class,
            EstadoSeeder::class,
            TecnicoSeeder::class,
            PacienteSeeder::class,
            MuestraSeeder::class,
        ]);
    }
}
