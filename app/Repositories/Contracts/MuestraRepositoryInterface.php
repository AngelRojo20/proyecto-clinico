<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface MuestraRepositoryInterface
{
    public function all(): Collection;
}
