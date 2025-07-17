<?php

namespace App\UseCases\Contracts\Pacientes;

use App\Models\Paciente;

interface ShowInterface
{
    public function handle(Paciente $paciente): array;
}
