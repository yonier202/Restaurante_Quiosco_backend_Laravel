<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['email', 'required', 'exists:users,email'],
            'password' => ['required']
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Debes ingresar un email.',
            'email.email' => 'El email ingresado no es válido.',
            'email.exists' => 'El email ingresado no se encuentra registrado.',
            'password.required' => 'Debes ingresar una contraseña.',
        ];
    }
}
