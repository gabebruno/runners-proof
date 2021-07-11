<?php

namespace App\Rules;

use App\Models\Race;
use App\Models\Runner;
use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Eloquent\RaceRepository;
use App\Repositories\Eloquent\RunnerRepository;

class AnotherRaceAtSameDay implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return mixed
     */
    public function passes($attribute, $value)
    {
        $index = explode('.',$attribute)[0];

        $runner = (new RunnerRepository)->find($value);
        $race = (new RaceRepository)->find(request()->input("{$index}.race_id"));

        if (!$this->checkIfExistsAnotherRaceAtSameDay($runner, $race)) {
            return false;
        }
        if (!$this->checkIfExistsAnotherRaceAtSameDayInRequest($race, $value)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Runner is subscribed in another race at same day, if not, check your request.';
    }

    /**
     * Check if exists, in database, other race with same date for this runner.
     *
     * @param Runner $runner
     * @param Race   $race
     *
     * @return bool
     */
    public function checkIfExistsAnotherRaceAtSameDay(Runner $runner, Race $race): bool
    {
        // Check if exist another subscribe for this runner in some race at same day in database.
        if ($runner->races()
            ->where('date', $race->date)
            ->exists()) {
            return false;
        }
        return true;
    }

    /**
     * Check if exists, in request, other race with same date for this runner.
     *
     * @param Race $race
     * @param      $value
     *
     * @return bool
     */
    public function checkIfExistsAnotherRaceAtSameDayInRequest(Race $race, $value): bool
    {
        //Check if exist another race at same day in request data.
        foreach (request()->all() as $singleRequest) {
            $raceRequest = (new RaceRepository)->find($singleRequest['race_id']);

            if ($raceRequest->id != $race->id && $singleRequest['runner_id'] == $value ) {
                if ($race->date == $raceRequest->date) {
                    return false;
                }
            }
        }
        return true;
    }
}
