<?php

namespace App\UseCases\Modules\Tecnicos;

use Illuminate\Http\Request;
use App\Models\Tecnico;
use App\UseCases\Contracts\Tecnicos\UpdateInterface;

class UpdateUseCases implements UpdateInterface
{
    public function handle(Request $request, Tecnico $tecnico): Tecnico
    {
        $validated = $request->validated(); // Asumiendo que se usa TecnicoUpdateForm

        $tecnico->update($validated);

        return $tecnico;
    }
}
