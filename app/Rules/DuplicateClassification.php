<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Eloquent\ClassificationRepository;

class DuplicateClassification implements Rule
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
        $classification = (new ClassificationRepository)->findByRace($raceId);

        return ($classification->where('runner_id', $value)->count() == 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The classification for this runner it\'s already registered.';
    }
}
