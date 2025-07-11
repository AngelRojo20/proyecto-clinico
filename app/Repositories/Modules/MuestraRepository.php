<?php

namespace App\Repositories\Modules;

use App\Models\Muestra;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\MuestraRepositoryInterface;

class MuestraRepository implements MuestraRepositoryInterface
{
    protected $muestra;

    public function __construct(Muestra $muestra)
    {
        $this->muestra = $muestra;
    }

    public function all(): Collection
    {
        return $this->muestra
            ->with(['tipoMuestra', 'estado', 'paciente', 'tecnico'])
            ->get();
    }
}
