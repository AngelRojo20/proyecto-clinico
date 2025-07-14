<?php

namespace App\Repositories\Modules;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Models\Paciente;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PacienteRepository implements PacienteRepositoryInterface
{
    protected $paciente;

    public function __construct(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Retrieve all Pacientes with their TipoDocumento relationship.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->paciente->with('tipoDocumento')->get();
    }

    public function paginate(int $cantidad = 10): LengthAwarePaginator
    {
        return Paciente::with('tipoDocumento')->paginate($cantidad);
    }
}
