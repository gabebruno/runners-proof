<?php

namespace App\Repositories\Eloquent;

use App\Models\Race;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RaceRepositoryInterface;


class RaceRepository extends BaseRepository implements RaceRepositoryInterface
{

    protected $model = Race::class;

    public function store(array $inputs)
    {
        $race = new $this->model ([
            'type' => $inputs['type'],
            'start' => $inputs['start'],
        ]);
        $race->save();

        return $race;
    }

    public function subscribe(array $inputs)
    {
        $race = $this->model->find($inputs['race_id']);

    }
}
