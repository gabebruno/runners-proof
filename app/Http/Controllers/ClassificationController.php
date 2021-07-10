<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ClassificationService;
use App\Http\Requests\StoreClassificationRequest;


class ClassificationController extends Controller
{
    /**
     * @var ClassificationService
     */
    private $service;

    public function __construct(ClassificationService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a resource in database
     *
     * @param StoreClassificationRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreClassificationRequest $request): JsonResponse
    {
        return $this->service->store($request);
    }


    public function getClassificationByAge()
    {
    }


    public function getGeneralClassification()
    {
    }
}
