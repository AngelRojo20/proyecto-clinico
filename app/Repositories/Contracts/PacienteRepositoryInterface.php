<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PacienteRepositoryInterface
{
    public function paginate(int $cantidad): LengthAwarePaginator;
    public function all(): Collection;
}
