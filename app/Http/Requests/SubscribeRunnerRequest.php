<?php

namespace App\Http\Requests;

use App\Rules\AnotherRaceAtSameDay;
use App\Rules\IsUniqueRunnerInRace;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeRunnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.runner_id' => [
                'required',
                'exists:runners,id',
                'numeric',
                new IsUniqueRunnerInRace,
                new AnotherRaceAtSameDay
            ],
            '*.race_id' => [
                'required',
                'exists:races,id',
                'numeric'
            ]
        ];
    }
}
