<?php

namespace App\UseCases\Contracts\Pacientes;

use App\Models\Paciente;
use Illuminate\Http\Request;

interface CreateInterface
{
    public function handle(Request $request): Paciente;
}
