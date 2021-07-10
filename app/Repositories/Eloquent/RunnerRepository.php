<?php

namespace App\Repositories\Eloquent;

use App\Models\Runner;
use App\Repositories\Contracts\RunnerRepositoryInterface;

class RunnerRepository extends BaseRepository implements RunnerRepositoryInterface
{
    protected $model = Runner::class;

    public function store(array $inputs): array
    {
        $runner = new $this->model([
            'name' => $inputs['name'],
            'cpf' => $inputs['cpf'],
            'birthday' => $inputs['birthday']
        ]);

        $runner->save();

        return $runner;
    }
}
