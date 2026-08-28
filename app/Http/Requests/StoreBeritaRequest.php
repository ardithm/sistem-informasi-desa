<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => [
                'required',
                'string',
                'max:200',
            ],

            'isi' => [
                'required',
                'string',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                ]),
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'judul berita',
            'isi' => 'isi berita',
            'gambar' => 'gambar berita',
            'status' => 'status berita',
            'published_at' => 'waktu publikasi',
        ];
    }
}
