<?php

namespace App\Http\Requests;

use App\Rules\HasRunnerInRace;
use App\Rules\FinishGreaterBegin;
use App\Rules\DuplicateClassification;
use Illuminate\Foundation\Http\FormRequest;

class StoreClassificationRequest extends FormRequest
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
                new DuplicateClassification,
                new HasRunnerInRace

            ],
            '*.race_id' => [
                'required',
                'exists:races,id',
                'numeric'
            ],
            '*.begin' => [
                'required',
                'date_format:H:i:s',
            ],
            '*.finish' => [
                'required',
                'date_format:H:i:s',
                new FinishGreaterBegin
            ]
        ];
    }
}
