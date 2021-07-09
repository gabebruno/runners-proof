<?php

namespace App\Services;

use App\Http\Requests\StoreRunnerRequest;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\RunnerRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RunnerService
{
    private $repo;

    public function __construct(RunnerRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store(StoreRunnerRequest $request)
    {
        dd($request);
        try{
            $inputs = $request->validated();
        } catch(ValidationException $e) {
            return response()->json(['message' => 'Validation fields error'], 400);
        }
        $runner = $this->repo->store($inputs);
        return response()->json(['message' => 'Runner ID:' . $runner->id], 201);

    }
}
