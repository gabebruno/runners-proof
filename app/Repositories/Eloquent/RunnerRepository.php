<?php

namespace App\Repositories\Eloquent;

use App\Models\Runner;
use App\Repositories\Contracts\RunnerRepositoryInterface;

class RunnerRepository extends BaseRepository implements RunnerRepositoryInterface
{
    /**
     * @var string
     */
    protected $model = Runner::class;

    /**
     * Store a resource in database
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function store(array $inputs)
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
