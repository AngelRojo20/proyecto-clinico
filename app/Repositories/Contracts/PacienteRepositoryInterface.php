<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PacienteRepositoryInterface
{
    public function all(): Collection;
}
