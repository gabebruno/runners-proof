<?php

namespace App\Repositories\Eloquent;

use App\Models\Race;
use App\Repositories\Contracts\RaceRepositoryInterface;

class RaceRepository extends BaseRepository implements RaceRepositoryInterface
{
    /**
     * @var string
     */
    protected $model = Race::class;

    /**
     * Store a resource in database
     *
     * @param array $inputs
     *
     * @return array
     */
    public function store(array $inputs): array
    {

        $race = new $this->model ([
            'type' => $inputs['type'],
            'date' => $inputs['date']
        ]);

        $race->save();

        return $race;
    }

    /**
     * Subscribe a runner in a race
     *
     * @param Race $race
     * @param int  $runnerId
     *
     * @return void
     */
    public function subscribe(Race $race, int $runnerId): void
    {
        try{
            $race->runners()->attach($runnerId);
        } catch(\Exception $e) {
            response()->json([$e->getMessage()], 401);
        }
    }
}
