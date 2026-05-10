<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class TakeComplaintRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|string',
            'note' => 'required|string|max_length:255',
            'complaint_code' => 'optional',
            'complaint_title' => 'optional',
            'complaint_location' => 'optional',
            'complaint_content' => 'optional',
            'complaint_image' => 'optional',
        ];
    }

    public function messages(): array
    {
        return [
            'note.required' => 'Catatan wajib diisi.',
            'note.max_length' => 'Catatan maksimal 255 karakter.',
        ];
    }

    protected function onFailure(array $errors): void
    {
        session()->setFlash('show_modal', true);
        session()->setFlash('modal', 'take-complaint-modal');

        parent::onFailure($errors);
    }
}
