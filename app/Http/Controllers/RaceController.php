<?php

namespace App\Http\Controllers;

use App\Services\RaceService;
use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\SubscribeRunnerRequest;
use Illuminate\Http\JsonResponse;

class RaceController extends Controller
{
    /**
     * @var RaceService
     */
    private $service;

    public function __construct(RaceService $service)
    {
        $this->service = $service;
    }

    /**
     * @param StoreRaceRequest $request
     * @return JsonResponse
     */
    public function store(StoreRaceRequest $request): JsonResponse
    {
        return $this->service->store($request);

    }

    /**
     * @param SubscribeRunnerRequest $request
     * @return JsonResponse
     */
    public function subscribe(SubscribeRunnerRequest $request): JsonResponse
    {
        return $this->service->subscribe($request);
    }
}
