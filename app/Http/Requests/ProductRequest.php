<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'amount' => 'integer|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'To pole jest wymagane',
            'description.required' => 'To pole jest wymagane',
            'amount.integer' => 'Nie poprawny format',
            'amount.required' => 'To pole jest wymagane',
        ];
    }

}
