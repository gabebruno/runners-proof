<?php

namespace App\Services;

use App\Repositories\Contracts\RunnerRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\ClassificationRepository;

class RunnerService
{
    private $runnerRepo;

    public function __construct(RunnerRepositoryInterface $runnerRepo)
    {
        $this->runnerRepo = $runnerRepo;
    }
}
