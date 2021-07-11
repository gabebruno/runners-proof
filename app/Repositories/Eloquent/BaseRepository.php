<?php

namespace App\Repositories\Eloquent;

class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * Method use to instantiate model on all implemented classes
     *
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function resolveModel()
    {
        return app($this->model);
    }

    /**
     * Get all results from model
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get all results following order parameter
     *
     * @param $order
     *
     * @return mixed
     */
    public function getWithOrderBy($order)
    {
        return $this->model->orderBy("$order")->get();
    }

    /**
     * Find a resource or fail.
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

}
