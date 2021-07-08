<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RaceService;

class RaceController extends Controller
{
    private $service;

    public function __construct(RaceService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
    }

    public function subscribeRunner()
    {
    }
}
