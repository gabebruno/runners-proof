<?php

namespace App\Repositories\Contracts;

interface RaceRepositoryInterface
{
    public function getAll();

    public function create();

    public function subscribeRunnerInRace();
}
