<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Eloquent\RaceRepository;

class HasRunnerInRace implements Rule
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
    public function passes($attribute, $value): bool
    {
        $index = explode('.',$attribute)[0];
        $raceId = request()->input("{$index}.race_id");
        $race = (new RaceRepository)->find($raceId);
        if ($race && $race->has('runners')) {
            return ($race->runners()->where('runner_id', $value)->exists());
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
        return 'Runner isn\'t subscribed on race';
    }
}
