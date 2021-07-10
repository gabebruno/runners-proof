<?php

namespace App\Services;

use App\Http\Requests\StoreRunnerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\RunnerRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RunnerService
{
    private $repo;

    public function __construct(RunnerRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store(StoreRunnerRequest $request): JsonResponse
    {
        $runners = [];

        $inputs = $request->validated();
        foreach ($inputs as $input) {
            $runner = $this->repo->store($input);
            $runners[] = $runner;
        }

        return response()->json([$runners], 201);
    }
}
