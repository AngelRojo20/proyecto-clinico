<?php

namespace App\UseCases\Contracts\Muestras;

use Illuminate\Http\Request;
use App\Models\Muestra;

interface CreateInterface
{
    public function handle(Request $request): Muestra;
}
