<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max_length:255',
            'email' => 'required|string|email|max_length:255',
            'phone' => 'required|numeric|min_length:9|max_length:15',
            'password' => 'required|string|min_length:8|max_length:255|confirmed',
            'password_confirmation' => 'required|string|min_length:8|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.max_length' => 'Username maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email format tidak valid.',
            'email.max_length' => 'Email maksimal 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.min_length' => 'Nomor telepon minimal 9 karakter.',
            'phone.max_length' => 'Nomor telepon maksimal 15 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min_length' => 'Password minimal 8 karakter.',
            'password.max_length' => 'Password maksimal 255 karakter.',
            'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Password konfirmasi wajib diisi.',
            'password_confirmation.min_length' => 'Password konfirmasi minimal 8 karakter.',
            'password_confirmation.max_length' => 'Password konfirmasi maksimal 255 karakter.',
        ];
    }
}
