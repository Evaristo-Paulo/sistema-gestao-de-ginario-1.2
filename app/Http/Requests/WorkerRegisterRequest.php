<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => "required|email|unique:users,email",
            'birthday' => 'required',
            'bi' => 'required|unique:workers,bi',
            'phone' => 'required',
            'gender' => 'required',
            'ocupation' => 'required',
            'hood' => 'required',
            'municipe' => 'required',
            'province' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo nome completo é de preenchimento obrigatório ',
            'email.email' => 'Campo email deve receber um email válido ',
            'email.required' => 'Campo email é de preenchimento obrigatório ',
            'gender.required' => 'Campo gênero é de preenchimento obrigatório ',
            'ocupation.required' => 'Campo gênero é de preenchimento obrigatório ',
            'hood.required' => 'Campo bairro é de preenchimento obrigatório ',
            'municipe.required' => 'Campo município é de preenchimento obrigatório ',
            'province.required' => 'Campo província é de preenchimento obrigatório ',
            'birthday.required' => 'Campo data de nascimento é de preenchimento obrigatório ',
            'bi.required' => 'Campo nº bi é de preenchimento obrigatório ',
            'phone.required' => 'Campo telefone é de preenchimento obrigatório ',
            'email.unique' => 'Já existe funcionário com este email ',
            'bi.unique' => 'Já existe funcionário com este nº bi ',
            'name.min' => 'Campo nome deve ter mais de 2 caracteres ',
        ];
    }
}
