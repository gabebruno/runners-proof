<?php

namespace App\Repositories\Contracts;

interface ClassificationRepositoryInterface
{
    public function getAll();

    public function store(array $inputs);

    public function getClassificationByAge();

    public function getGeneralClassification();
}
