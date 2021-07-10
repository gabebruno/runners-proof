<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassificationService;


class ClassificationController extends Controller
{
    private $service;

    public function __construct(ClassificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store()
    {
    }

    public function getClassificationByAge()
    {
    }

    public function getGeneralClassification()
    {
    }
}
