<?php

namespace App\Rules;

use App\Models\Race;
use Illuminate\Contracts\Validation\Rule;

class IsUniqueRunnerInRace implements Rule
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
    public function passes($attribute, $value)
    {
        $index = explode('.',$attribute)[0];
        $raceId = request()->input("{$index}.race_id");
        $race = Race::find($raceId);

        return !($race->runners()->where('runner_id', $value)->first());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Runner is already subscribed in the race.';
    }
}
