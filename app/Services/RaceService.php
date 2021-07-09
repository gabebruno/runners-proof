<?php

namespace App\Services;

use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\SubscribeRunnerRequest;
use App\Repositories\Contracts\RaceRepositoryInterface;

class RaceService
{
    private $repo;

    public function __construct(RaceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store(StoreRaceRequest $request)
    {
        return $this->repo->store($request->validated());
    }

    public function subscribe(SubscribeRunnerRequest $request)
    {
        return $this->repo->subscribe($request->validated());
    }
}
