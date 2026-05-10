<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'optional|string',
            'name' => 'required|string|max_length:50',
            'description' => 'required|string|max_length:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max_length' => 'Nama kategori maksimal 50 karakter.',
            'description.required' => 'Deskripsi kategori wajib diisi.',
            'description.max_length' => 'Deskripsi kategori maksimal 255 karakter.',
        ];
    }

    protected function onFailure(array $errors): void
    {
        session()->setFlash('show_modal', true);
        session()->setFlash('modal', 'category-modal');

        parent::onFailure($errors);
    }
}
