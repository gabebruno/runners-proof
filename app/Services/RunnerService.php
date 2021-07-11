<?php

namespace App\Services;

use App\Http\Requests\StoreRunnerRequest;
use App\Repositories\Contracts\RunnerRepositoryInterface;

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
     * Store a resource in database
     *
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
