<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max_length:255',
            'password' => 'required|string|min_length:8|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email format tidak valid.',
            'email.max_length' => 'Email maksimal 255 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min_length' => 'Password minimal 8 karakter.',
            'password.max_length' => 'Password maksimal 255 karakter.',
        ];
    }
}
