<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'optional|string',
            'username' => 'required|string|max_length:50',
            'email' => 'required|string|email',
            'password' => $this->input('id') ? 'optional' : 'required|string|min_length:8',
            'phone' => 'required|string|phone',
            'address' => 'optional|string|max_length:255',
            'role' => 'required|string|in:worker,citizen',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Nama wajib diisi.',
            'username.max_length' => 'Nama maksimal 50 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min_length' => 'Password minimal 8 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'address.max_length' => 'Alamat maksimal 255 karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.in' => 'Role tidak valid.',
        ];
    }

    protected function onFailure(array $errors): void
    {
        session()->setFlash('show_modal', true);
        session()->setFlash('modal', 'user-modal');

        parent::onFailure($errors);
    }
}
