<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class ResponseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|string',
            'message' => 'required|string|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Tanggapan wajib diisi.',
            'message.max_length' => 'Tanggapan maksimal 255 karakter.',
        ];
    }
}
