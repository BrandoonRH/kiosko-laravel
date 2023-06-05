<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El Email es Obligatorio', 
            'email.email' => 'El Email no es Válido', 
            'email.exists' => 'Esa Cuenta no Existe', 
            'password' => 'El password es Obligatorio'
        ];
    }
}
