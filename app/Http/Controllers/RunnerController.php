<?php

namespace App\Http\Controllers;

use App\Services\RunnerService;
use Illuminate\Http\Request;

class RunnerController extends Controller
{
    private $service;

    public function __construct(RunnerService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
    }
}
