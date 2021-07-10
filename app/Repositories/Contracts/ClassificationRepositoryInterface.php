<?php

namespace App\Repositories\Contracts;

use App\Http\Resources\ClassificationByAgeResource;
use App\Http\Resources\GeneralClassificationResource;

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
    public function store(array $inputs);

    /**
     * Get classification by age of runners
     *
     * The list of classifications by age must be show the runners positions
     * inside the following groups in each proof type.
     * o 18 – 25 years
     * o 25 – 35 years
     * o 35 – 45 years
     * o 45 – 55 years
     * o Up to 55 years
     * Example: the positions 18 -25 in 3km race will show the 1º,2º, 3º, ...
     * in this age range, the same for the others ranges and proof types.
     *
     * @return mixed
     */
    public function getClassificationByAge(
        ClassificationByAgeResource $byAgeResource,
        int $perPage
    );

    /**
     * Get general classification by race
     *
     * The list of classifications must be separeted by type of proofs.
     *
     * @return mixed
     */
    public function getGeneralClassification(
        GeneralClassificationResource $generalResource,
        int $perPage
    );
}
