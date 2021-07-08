<?php

namespace App\Repositories\Eloquent;

use Models\Runner;
use App\Repositories\Contracts\RunnerRepositoryInterface;

class RunnerRepository extends AbstractRepository implements RunnerRepositoryInterface
{
    protected $model = Runner::class;

    public function create()
    {
    }
}
