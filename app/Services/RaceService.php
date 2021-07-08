<?php

namespace App\Services;

use App\Repositories\Contracts\RaceRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class RaceService
{
    private $raceRepo;

    public function __construct(RaceRepositoryInterface $raceRepo)
    {
        $this->raceRepo = $raceRepo;
    }
}
