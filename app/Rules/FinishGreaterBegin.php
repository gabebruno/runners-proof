<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FinishGreaterBegin implements Rule
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
        $begin = request()->input("{$index}.begin");

        return ($begin <= $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The finish time must greater then begin.';
    }
}
