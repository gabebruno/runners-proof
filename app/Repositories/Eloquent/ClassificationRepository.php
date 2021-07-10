<?php

namespace App\Repositories\Eloquent;

use App\Models\Classification;
use App\Repositories\Contracts\ClassificationRepositoryInterface;

class ClassificationRepository extends BaseRepository implements ClassificationRepositoryInterface
{
    protected $model = Classification::class;

    public function getClassificationByAge()
    {
    }

    public function getGeneralClassification()
    {
    }

    public function store(array $inputs)
    {
    }
}
