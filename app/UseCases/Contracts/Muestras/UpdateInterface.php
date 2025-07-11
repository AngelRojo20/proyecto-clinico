<?php

namespace App\UseCases\Contracts\Muestras;

use Illuminate\Http\Request;
use App\Models\Muestra;

interface UpdateInterface
{
    public function handle(Request $request, Muestra $muestra): Muestra;
}
