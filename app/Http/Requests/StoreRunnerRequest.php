<?php

namespace App\Http\Requests;

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
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'cnpj' => ['required', 'cnpj', 'unique:runners,cnpj'],
            'birthday' => ['required', 'date']
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return array
     */
    protected function prepareForValidation()
    {
        $attributes = parent::all();

        $attributes['cnpj'] = preg_replace('/\D/', '', $attributes['cnpj']);
        parent::replace($attributes);

        return parent::all();
    }
}
