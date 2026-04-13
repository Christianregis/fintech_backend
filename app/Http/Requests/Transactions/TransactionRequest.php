<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'receiver_phone' => 'required|exists:users,phone',
            'amount' => 'required|integer|min:1',
            'reference' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'receiver_phone.required' => 'Le champ receiver_phone est requis.',
            'receiver_phone.exists' => 'Le numéro de téléphone doit correspondre à un utilisateur existant.',
            'amount.required' => 'Le champ amount est requis.',
            'amount.integer' => 'Le champ amount doit être un entier.',
            'amount.min' => 'Le montant doit être au moins de 1.',
            'reference.required' => 'Le champ reference est requis.',
            'reference.string' => 'Le champ reference doit être une chaîne de caractères.',
            'reference.max' => 'Le champ reference ne doit pas dépasser 255 caractères.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
        ];
    }
}
