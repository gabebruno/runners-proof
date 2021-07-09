<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface RaceRepositoryInterface
{
    public function getAll();

    public function store(array $inputs);

    public function subscribe(array $inputs);
}
