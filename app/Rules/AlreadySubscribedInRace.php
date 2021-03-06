<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Eloquent\RaceRepository;

class AlreadySubscribedInRace implements Rule
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
     * @param  integer  $raceId
     * @param  integer  $runnerId
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $index = explode('.',$attribute)[0];
        $raceId = request()->input("{$index}.race_id");
        if ($race = (new RaceRepository)->find($raceId)) {
            return !($race->runners()->where('runner_id', $value)->first());
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
        return 'Runner is already subscribed in the race.';
    }
}
