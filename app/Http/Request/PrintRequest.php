<?php

namespace App\Http\Request;

use App\Foundation\Http\FormRequest;

class PrintRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'optional|date',
            'end_date' => 'optional|date',
            'status' => 'optional|string',
            'print_option' => 'required|string|in:complaint-only,full',
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.date' => 'Tanggal mulai harus berformat tanggal',
            'end_date.date' => 'Tanggal akhir harus berformat tanggal',
            'print_option.required' => 'Pilihan cetak harus dipilih',
        ];
    }
}
