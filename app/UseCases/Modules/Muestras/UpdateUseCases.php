<?php

namespace App\UseCases\Modules\Muestras;

use Illuminate\Http\Request;
use App\Models\Muestra;
use App\UseCases\Contracts\Muestras\UpdateInterface;

class UpdateUseCases implements UpdateInterface
{
    public function handle(Request $request, Muestra $muestra): Muestra
    {
        $validated = $request->validated(); // Usa MuestraUpdateForm

        $muestra->update($validated);

        return $muestra;
    }
}
