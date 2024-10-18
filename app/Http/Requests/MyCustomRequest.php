<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyCustomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Return true if authorized.
     */
    public function authorize(): bool
    {
        return true; // Set this to true to allow access
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',  // `confirmed` checks for matching password confirmation field (password_confirmation)
        ];
    }

    /**
     * Customize validation messages (optional).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'An email address is required.',
            'password.min' => 'The password must be at least 6 characters.',
        ];
    }
}
