<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string|min_length:8|max_length:255',
            'new_password' => 'required|string|min_length:8|max_length:255|confirmed',
            'new_password_confirmation' => 'required|string|min_length:8|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Password lama wajib diisi.',
            'password.min_length' => 'Password lama minimal 8 karakter.',
            'password.max_length' => 'Password lama maksimal 255 karakter.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min_length' => 'Password baru minimal 8 karakter.',
            'new_password.max_length' => 'Password baru maksimal 255 karakter.',
            'new_password.confirmed' => 'Password baru dan konfirmasi password tidak cocok.',
            'new_password_confirmation.required' => 'Password baru konfirmasi wajib diisi.',
            'new_password_confirmation.min_length' => 'Password baru konfirmasi minimal 8 karakter.',
            'new_password_confirmation.max_length' => 'Password baru konfirmasi maksimal 255 karakter.',
        ];
    }
}
