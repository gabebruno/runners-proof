<?php

namespace App\Repositories\Eloquent;

use Models\Race;
use App\Repositories\Contracts\RaceRepositoryInterface;


class RaceRepository extends AbstractRepository implements RaceRepositoryInterface
{
    protected $model = Race::class;


}
