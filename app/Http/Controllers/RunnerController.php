<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\RunnerService;
use App\Http\Requests\StoreRunnerRequest;

class RunnerController extends Controller
{
    /**
     * @var RunnerService
     */
    private $service;

    public function __construct(RunnerService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a resource on database
     *
     * @param StoreRunnerRequest $request
     *
     * @return array
     */
    public function store(StoreRunnerRequest $request): array
    {
        return $this->service->store($request);
    }
}
