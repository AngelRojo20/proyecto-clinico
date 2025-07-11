<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface TecnicoRepositoryInterface
{
    public function all(): Collection;
}
