<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => "string|max:255|email|required",
            "password" => "string|required",
        ];
    }

    public function messages(): array
    {
        return [
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.max' => 'Le champ email ne doit pas dépasser 255 caractères.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.required' => 'Le champ email est requis.',
            'password.string' => 'Le champ password doit être une chaîne de caractères.',
            'password.required' => 'Le champ password est requis.',
        ];
    }
}
