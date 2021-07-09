<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RaceService;
use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\SubscribeRunnerRequest;

class RaceController extends Controller
{
    private $service;

    public function __construct(RaceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(StoreRaceRequest $request)
    {
        $race = $this->service->store($request);
        return response()->json([$race], 201);
    }

    public function subscribe(SubscribeRunnerRequest $request)
    {
        $this->service->subscribe($request);
        return response()->json(['message' => "Subscribed"], 201);
    }
}
