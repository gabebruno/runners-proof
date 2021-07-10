<?php

namespace App\Services;

use App\Models\Runner;
use App\Helpers\AgeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Resources\ClassificationByAgeResource;
use App\Http\Resources\GeneralClassificationResource;
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

    public function getClassification(Request $request)
    {
        $byAge = request('byAge');
        $perPage = request('perPage') ? request('perPage') : 15;

        if ($byAge){
            $byAgeResource = new ClassificationByAgeResource($request);
            return $this->repo->getClassificationByAge($byAgeResource, $perPage);
        }

        $generalResource = new GeneralClassificationResource($request);
        return $this->repo->getGeneralClassification( $generalResource,$perPage);

    }

    /**
     * Find a runner
     *
     * Crossing references to check runner information for store method.
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
