<?php

namespace App\Rules;

use App\Helpers\AgeHelper;
use Illuminate\Contracts\Validation\Rule;

class InLegalAge implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return AgeHelper::inLegalAge($value['birthday']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The runner is underage.';
    }

}
