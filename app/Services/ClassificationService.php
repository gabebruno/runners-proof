<?php

namespace App\Services;

use App\Models\Runner;
use App\Helpers\AgeHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreClassificationRequest;
use App\Repositories\Contracts\RunnerRepositoryInterface;
use App\Repositories\Contracts\ClassificationRepositoryInterface;

class ClassificationService
{
    /**
     * @var ClassificationRepositoryInterface
     */
    private $repo;

    /**
     * @var RunnerRepositoryInterface
     */
    private $runnerRepo;

    public function __construct(
        ClassificationRepositoryInterface $repo,
        RunnerRepositoryInterface $runnerRepo
    )
    {
        $this->repo = $repo;
        $this->runnerRepo = $runnerRepo;
    }

    /**
     * Store a resource in database
     *
     * @param StoreClassificationRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreClassificationRequest $request): JsonResponse
    {
        $classifications = [];

        $validArray = $request->validated();

        foreach ($validArray as $key => $valid) {
            $runner = $this->findRunner($valid['runner_id']);

            $valid['runner_age'] = (new AgeHelper)->calculateAge($runner->birthday);
            $classification = $this->repo->store($valid);
            $classifications[] = $classification;
        }

        return response()->json($classifications, 201);
    }

    public function getClassificationByAge()
    {
    }

    public function getGeneralClassification()
    {
    }

    /**
     * Find a runner
     *
     * Crossing references to check runner information.
     *
     * @param int $id
     *
     * @return Runner
     */
    public function findRunner(int $id): Runner
    {
        return $this->runnerRepo->find($id);
    }
}
