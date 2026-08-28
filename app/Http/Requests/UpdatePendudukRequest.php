<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePendudukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $penduduk = $this->route('penduduk');

        return [
            'nik' => [
                'required',
                'string',
                'size:16',
                Rule::unique('penduduks', 'nik')
                    ->ignore($penduduk->id),
            ],

            'nama_lengkap' => [
                'required',
                'string',
                'max:150',
            ],

            'tempat_lahir' => [
                'required',
                'string',
                'max:100',
            ],

            'tanggal_lahir' => [
                'required',
                'date',
            ],

            'jenis_kelamin' => [
                'required',
                'in:L,P',
            ],

            'status_perkawinan' => [
                'required',
                'in:belum_kawin,kawin,cerai_hidup,cerai_mati',
            ],

            'pekerjaan' => [
                'required',
                'string',
                'max:100',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'rt' => [
                'required',
                'string',
                'max:3',
            ],

            'rw' => [
                'required',
                'string',
                'max:3',
            ],

            'status_penduduk' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nik' => 'NIK',
            'nama_lengkap' => 'nama lengkap',
            'tempat_lahir' => 'tempat lahir',
            'tanggal_lahir' => 'tanggal lahir',
            'jenis_kelamin' => 'jenis kelamin',
            'status_perkawinan' => 'status perkawinan',
            'rt' => 'RT',
            'rw' => 'RW',
            'status_penduduk' => 'status penduduk',
        ];
    }
}
