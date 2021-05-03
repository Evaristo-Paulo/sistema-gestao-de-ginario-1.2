<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerChangePhotoRequest extends FormRequest
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
            'email' => "required|email",
            'photo' => 'required|mimes:png,jpg,jpeg'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Campo email é de preenchimento obrigatório ',
            'email.email' => 'Campo email deve receber um email válido ',
            'photo.mimes' => 'Carrega uma foto válida (.png, .jpg, .jpeg) ',
            'photo.required' => 'Campo fotografia é de preenchimento obrigatório ',
        ];
    }
}
