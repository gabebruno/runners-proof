<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Rules\InLegalAge;
use Illuminate\Foundation\Http\FormRequest;

class StoreRunnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
        return[
            '*.name' => ['required', 'string'],
            '*.cpf' => ['required', 'cpf', 'unique:runners', 'distinct'],
            '*.birthday' => ['required', 'date'],
            '*' => new InLegalAge,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            '*.cpf.unique' => 'CPF is already in our registers.',
            '*.cpf.cpf' => 'Invalid CPF number.',
            '*.cpf.distinct' => 'CPF is duplicate in this request.',
            '*.birthday.date' => 'Value is not valid, please check documentation.',
            '*.name.string' => 'Value is not valid, please check documentation.',
            '*.*.required' => 'Missing required fields.',
            '*.*.InLegalAge' => 'Runner is underage.'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return array
     */
    protected function prepareForValidation(): array
    {
        $runners = parent::all();

        foreach ($runners as $runner) {
            $runner['cpf'] = preg_replace('/\D/', '', $runner['cpf']);
        }
        parent::replace($runners);
        return parent::all();
    }
}
