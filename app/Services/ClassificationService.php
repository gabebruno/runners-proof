<?php

namespace App\Services;

use App\Repositories\Contracts\ClassificationRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ClassificationService
{
    private $classificationRepo;

    public function __construct(ClassificationRepositoryInterface $classificationRepo)
    {
        $this->classificationRepo = $classificationRepo;
    }
}
