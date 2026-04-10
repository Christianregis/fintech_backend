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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> "string|max:255|required",
            "email"=>"email|max:255|unique:users|required",
            "phone" => "string|required|max:10",
            "avatar_url"=> "string|max:255|nullable"
        ];
    }
}
