<?php

namespace App\Repositories\Eloquent;

use Models\Classification;
use App\Repositories\Contracts\ClassificationRepositoryInterface;

class ClassificationRepository extends AbstractRepository implements ClassificationRepositoryInterface
{
    protected $model = Classification::class;

    public function store()
    {
    }

    public function getClassificationByAge()
    {
    }

    public function getGeneralClassification()
    {
    }

    public function setResults()
    {
    }
}
