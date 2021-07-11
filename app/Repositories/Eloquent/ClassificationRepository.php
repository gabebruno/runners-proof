<?php

namespace App\Repositories\Eloquent;

use App\Models\Classification;
use App\Repositories\Contracts\ClassificationRepositoryInterface;

class ClassificationRepository extends BaseRepository implements ClassificationRepositoryInterface
{
    /**
     * @var Classification
     */
    protected $model = Classification::class;

    /**
     * Update a resource on database
     *
     * Register classifications on database following those rules:
     * Finish time needs to be greater then begin
     * By my option, runner's age were stored with classifications data
     * because is your age when the proof was realized, for records.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function registerResults(array $inputs)
    {
        $classification = $this->model
                ->where('runner_id', $inputs['runner_id'])
                ->where('race_id', $inputs['race_id']);

        return $classification->update($inputs);
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
