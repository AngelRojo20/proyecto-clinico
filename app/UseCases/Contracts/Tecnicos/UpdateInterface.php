<?php

namespace App\UseCases\Contracts\Tecnicos;

use Illuminate\Http\Request;
use App\Models\Tecnico;

interface UpdateInterface
{
    public function handle(Request $request, Tecnico $tecnico): Tecnico;
}
