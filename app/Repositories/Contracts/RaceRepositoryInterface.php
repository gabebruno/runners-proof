<?php

namespace App\Repositories\Contracts;

use App\Models\Race;

interface RaceRepositoryInterface
{
    public function find($id);

    public function getAll();

    public function store(array $inputs);

    public function subscribe(Race $race, int $runnerId);
}
