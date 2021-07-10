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
        $subscribes = [];

        $validArray = $request->validated();

        foreach ($validArray as $key => $valid) {
            $race = $this->repo->find($valid['race_id']);

            if (!$race->runners->find($valid['runner_id'])) {
                $this->repo->subscribe($race, $valid['runner_id']);
                $subscribes[] = $valid;
            }
        }
        return $subscribes;
    }
}
