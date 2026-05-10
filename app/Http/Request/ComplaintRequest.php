<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min_length:10|max_length:255',
            'category' => 'required|string',
            'location' => 'required|string|max_length:255',
            'description' => 'required|string|min_length:20|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'title.min_length' => 'Judul minimal 10 karakter.',
            'title.max_length' => 'Judul maksimal 255 karakter.',
            'category.required' => 'Kategori wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'location.max_length' => 'Lokasi maksimal 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.min_length' => 'Deskripsi minimal 20 karakter.',
            'description.max_length' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
