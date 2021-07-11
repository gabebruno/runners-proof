<?php

namespace App\Http\Controllers;

use App\Services\ResultService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResultController extends Controller
{
    /**
     * @var ResultService
     */
    private $service;

    public function __construct(ResultService $service)
    {
        $this->service = $service;
    }

    /**
     * Get classification list
     *
     * @return AnonymousResourceCollection
     */
    public function getClassifications(): AnonymousResourceCollection
    {
        return $this->service->getClassifications();
    }
}
