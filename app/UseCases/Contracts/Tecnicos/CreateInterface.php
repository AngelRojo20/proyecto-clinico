<?php

namespace App\UseCases\Contracts\Tecnicos;

use Illuminate\Http\Request;
use App\Models\Tecnico;

interface CreateInterface
{
    public function handle(Request $request): Tecnico;
}
