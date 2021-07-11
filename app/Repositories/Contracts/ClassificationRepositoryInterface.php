<?php

namespace App\Repositories\Contracts;

interface ClassificationRepositoryInterface
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
     * @param array $inputs
     * @return mixed
     */
    public function registerResults(array $inputs);

}
