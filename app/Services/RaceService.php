<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\SubscribeRunnerRequest;
use App\Http\Resources\ClassificationByAgeResource;
use App\Repositories\Contracts\RaceRepositoryInterface;

class RaceService
{
    /**
     * @var RaceRepositoryInterface
     */
    private $repo;

    public function __construct(RaceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param StoreRaceRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRaceRequest $request): JsonResponse
    {
        $races = [];
        $validArray = $request->validated();

        foreach($validArray as $valid){
            $race = $this->repo->store($valid);
            $races[] = $race;
        }

        return response()->json([$races], 201);

    }

    /**
     * @param SubscribeRunnerRequest $request
     *
     * @return JsonResponse
     */
    public function subscribe(SubscribeRunnerRequest $request): JsonResponse
    {
        $subscribes = [];

        $validArray = $request->validated();

        foreach ($validArray as $valid) {
            $race = $this->repo->find($valid['race_id']);

            if (!$race->runners->find($valid['runner_id'])) {
                $this->repo->subscribe($race, $valid['runner_id']);
                $subscribes[] = $valid;
            }
        }
        return response()->json([$subscribes], 201);
    }

    public function getClassification()
    {
        $byAge = boolval(request('byAge'));
        $perPage = request('perPage') ? intval(request('perPage')) : 15;

        $classificationByAge = new ClassificationByAgeResource($this->repo->getClassificationByAge($perPage));
        return $classificationByAge;
    }
}
