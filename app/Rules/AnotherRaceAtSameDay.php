<?php

namespace App\Rules;

use App\Models\Race;
use App\Models\Runner;
use Illuminate\Contracts\Validation\Rule;

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
        $runner = Runner::find($value);

        $index = explode('.',$attribute)[0];
        $raceId = request()->input("{$index}.race_id");
        $race = Race::find($raceId);

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
