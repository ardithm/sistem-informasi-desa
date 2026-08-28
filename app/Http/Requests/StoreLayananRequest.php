<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode' => [
                'required',
                'string',
                'max:20',
                'unique:layanans,kode',
            ],

            'nama_layanan' => [
                'required',
                'string',
                'max:150',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode' => 'kode layanan',
            'nama_layanan' => 'nama layanan',
            'deskripsi' => 'deskripsi',
            'aktif' => 'status layanan',
        ];
    }
}
