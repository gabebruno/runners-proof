<?php

namespace App\Services;

use App\Repositories\Contracts\ClassificationRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ClassificationService
{
    private $repo;

    public function __construct(ClassificationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
