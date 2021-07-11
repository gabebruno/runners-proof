<?php

namespace App\Repositories\Contracts;

interface ResultRepositoryInterface
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
     * Get resources with orderBy clause
     *
     * @param string $order
     *
     * @return mixed
     */
    public function getWithOrderBy(string $order);
}
