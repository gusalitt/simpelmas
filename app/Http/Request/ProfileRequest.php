<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max_length:255',
            'email' => 'required|string|email|max_length:255',
            'phone' => 'required|numeric|min_length:9|max_length:15',
            'address' => 'optional|string|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Nama wajib diisi.',
            'username.max_length' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max_length' => 'Email maksimal 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.min_length' => 'Nomor telepon minimal 9 karakter.',
            'phone.max_length' => 'Nomor telepon maksimal 15 karakter.',
            'address.max_length' => 'Alamat maksimal 255 karakter.',
        ];
    }
}
