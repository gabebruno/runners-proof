<?php

namespace App\Repositories\Eloquent;

class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getWithOrderBy($order)
    {
        return $this->model->orderBy("$order")->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

}
