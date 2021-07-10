<?php

namespace App\Repositories\Contracts;

interface RunnerRepositoryInterface
{

    /**
     * Find a resource on database
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Get all resources in database
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Store a resource in database
     *
     * Rules:
     * A runner don't be stored if is underage
     * CPF is a unique field in validations
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function store(array $inputs);
}
