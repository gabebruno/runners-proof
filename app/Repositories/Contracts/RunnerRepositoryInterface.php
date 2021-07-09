<?php

namespace App\Repositories\Contracts;

interface RunnerRepositoryInterface
{
    public function getAll();

    public function store(array $inputs);
}
