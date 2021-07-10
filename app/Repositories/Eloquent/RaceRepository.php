<?php

namespace App\Repositories\Eloquent;

use App\Models\Race;
use App\Repositories\Contracts\RaceRepositoryInterface;

class RaceRepository extends BaseRepository implements RaceRepositoryInterface
{
    protected $model = Race::class;

    public function store(array $inputs): array
    {
        $races = [];

        foreach($inputs as $input){

            $race = new $this->model ([
                'type' => $input['type'],
                'date' => $input['date']
            ]);

            $race->save();
            $races[] = $race;
        }
        return $races;
    }

    public function subscribe($race, $runnerId): bool
    {
        $race->runners()->attach($runnerId);

        return true;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
