<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRegisterRequest extends FormRequest
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
            'client' => "required",
            'status' => 'required',
            'month' => 'required',
            'value' => 'required|numeric',
            'year' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'client.required' => 'Campo Cliente é de preenchimento obrigatório ',
            'status.required' => 'Campo estado é de preenchimento obrigatório ',
            'month.required' => 'Campo mês é de preenchimento obrigatório ',
            'value.required' => 'Campo valor é de preenchimento obrigatório ',
            'year.required' => 'Campo município é de preenchimento obrigatório ',
            'value.numeric' => 'Campo valor deve ser númerico ',
        ];
    }
}
