<?php

namespace App\Rules;

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
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $runner = (new RunnerRepository)->find($value);

        $index = explode('.',$attribute)[0];
        $raceId = request()->input("{$index}.race_id");
        $race = (new RaceRepository)->find($raceId);

        return !($runner->races()->where('date', $race->date)->where('race_id', '!=' ,$race->id)->first());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The runner is subscribed in another race at same day.';
    }
}
