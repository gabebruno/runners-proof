<?php

namespace App\Repositories\Contracts;

use App\Models\Race;

interface RaceRepositoryInterface
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
     *
     * @return mixed
     */
    public function store(array $inputs);

    /**
     * Subscribe runners in races
     *
     * Subscription follow the rules below:
     * A runner don't run in two races at same day
     * A runner don't be subscribed two times at same race
     *
     * @param Race $race
     * @param int  $runnerId
     *
     * @return mixed
     */
    public function subscribe(Race $race, int $runnerId);
}
