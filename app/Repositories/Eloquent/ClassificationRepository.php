<?php

namespace App\Repositories\Eloquent;

use App\Models\Classification;
use App\Http\Resources\ClassificationByAgeResource;
use App\Http\Resources\GeneralClassificationResource;
use App\Repositories\Contracts\ClassificationRepositoryInterface;

class ClassificationRepository extends BaseRepository implements ClassificationRepositoryInterface
{
    /**
     * @var Classification
     */
    protected $model = Classification::class;

    public function getClassificationByAge(
        ClassificationByAgeResource $byAgeResource,
        int $perPage
    )
    {
        return $this->model->with('runner')->with('race')->get();
    }

    public function getGeneralClassification(
        GeneralClassificationResource $generalResource,
        int $perPage
    )
    {
        return $this->model->with('runner')->with('race')->get();
    }

    /**
     * Store a resource on database
     *
     * Register classifications on database following those rules:
     * Runner needs to be attached to race
     * Finish time needs to be greater then begin
     * By my option, runner's age were stored with classifications data
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function store(array $inputs)
    {
        $classification = new $this->model ([
            'runner_id' => $inputs['runner_id'],
            'race_id' => $inputs['race_id'],
            'begin' => $inputs['begin'],
            'finish' => $inputs['finish'],
            'runner_age' => $inputs['runner_age']
            ]);

        return $classification->save();
    }

    /**
     * Find classifications by raceId
     *
     * @param $raceId
     *
     * @return mixed
     */
    public function findByRace($raceId)
    {
        return $this->model->where('race_id', $raceId)->get();
    }

}
