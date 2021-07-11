<?php

namespace App\Services;

use Carbon\Carbon;
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
    public function registerResults(StoreClassificationRequest $request): JsonResponse
    {
        $classifications = [];

        $validArray = $request->validated();

        foreach ($validArray as $valid) {

            $totalTime = $this->calculateTotalTime($valid['begin'], $valid['finish']);

            $runner = $this->findRunnerById($valid['runner_id']);
            $valid['runner_age'] = AgeHelper::calculateAge($runner->birthday);
            $valid['total_time'] = date("H:i:s", strtotime($totalTime));
            $valid['begin'] = date("H:i:s", strtotime($valid['begin']));
            $valid['finish'] = date("H:i:s", strtotime($valid['finish']));
            $this->repo->registerResults($valid);
        }

        return response()->json($classifications, 201);
    }

    /**
     * Find a runner
     *
     * Crossing references to check runner information for registerResults method.
     *
     * @param int $id
     *
     * @return Runner
     */
    public function findRunnerById(int $id): Runner
    {
        return $this->runnerRepo->find($id);
    }

    /**
     * Calculate total proof time from a runner
     *
     * Using begin and finish time, total time is calculate to define ranking.
     *
     * @param $begin
     * @param $finish
     *
     * @return string
     */
    private function calculateTotalTime($begin, $finish): string
    {
        return Carbon::parse($begin)
            ->diff(Carbon::parse($finish))
            ->format('%H:%I:%S');
    }
}
