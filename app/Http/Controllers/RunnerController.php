<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\RunnerService;
use App\Http\Requests\StoreRunnerRequest;

class RunnerController extends Controller
{
    private $service;

    public function __construct(RunnerService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(StoreRunnerRequest $request): JsonResponse
    {
        return $this->service->store($request);
    }
}
