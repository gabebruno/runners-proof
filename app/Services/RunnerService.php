<?php

namespace App\Services;

use App\Http\Requests\StoreRunnerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\RunnerRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RunnerService
{
    /**
     * @var RunnerRepositoryInterface
     */
    private $repo;

    public function __construct(RunnerRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param StoreRunnerRequest $request
     *
     * @return array
     */
    public function store(StoreRunnerRequest $request): array
    {
        $runners = [];

        $inputs = $request->validated();
        foreach ($inputs as $input) {
            $runner = $this->repo->store($input);
            $runners[] = $runner;
        }

        return $runners;
    }
}
