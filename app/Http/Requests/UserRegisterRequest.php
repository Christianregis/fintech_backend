<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> "string|max:255|required",
            "email"=>"email|max:255|unique:users|required",
            "phone" => "string|required|max:20|required|unique:users",
            "avatar_url"=> "string|max:255|nullable",
            "password"=> "string|min:8|required"
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Le champ name doit être une chaîne de caractères.',
            'name.max' => 'Le champ name ne doit pas dépasser 255 caractères.',
            'name.required' => 'Le champ name est requis.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.max' => 'Le champ email ne doit pas dépasser 255 caractères.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
            'email.required' => 'Le champ email est requis.',
            'phone.string' => 'Le champ phone doit être une chaîne de caractères.',
            'phone.max' => 'Le champ phone ne doit pas dépasser 20 caractères.',
            'phone.unique' => 'Le numéro de téléphone est déjà utilisé.',
            'phone.required' => 'Le champ phone est requis.',
            'avatar_url.string' => 'Le champ avatar_url doit être une chaîne de caractères.',
            'avatar_url.max' => 'Le champ avatar_url ne doit pas dépasser 255 caractères.',
            'avatar_url.nullable' => 'Le champ avatar_url peut être nul.',
            'password.string' => 'Le champ password doit être une chaîne de caractères.',
            'password.min' => 'Le champ password doit contenir au moins 8 caractères.',
            'password.required' => 'Le champ password est requis.',
        ];
    }
}
