<?php

namespace App\Repositories\Modules;

use App\Models\Tecnico;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\TecnicoRepositoryInterface;

class TecnicoRepository implements TecnicoRepositoryInterface
{
    protected $tecnico;

    public function __construct(Tecnico $tecnico)
    {
        $this->tecnico = $tecnico;
    }

    /**
     * Retorna todos los técnicos con su tipo de documento.
     */
    public function all(): Collection
    {
        return $this->tecnico->with('tipoDocumento')->get();
    }
}
