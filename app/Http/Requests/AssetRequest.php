<?php

namespace App\Http\Requests;

use App\Models\Asset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false; // lapis kedua selain middleware
    }

    public function rules(): array
    {
        return [
            'kode'         => ['required', 'string', 'max:50', Rule::unique('assets', 'kode')->ignore($this->route('asset'))],
            'nama'         => ['required', 'string', 'max:255'],
            'category_id'  => ['required', 'exists:categories,id'],
            'lokasi'       => ['required', 'string', 'max:255'],
            'status'       => ['required', Rule::in(Asset::STATUSES)],
            'tanggal_beli' => ['required', 'date', 'before_or_equal:today'],
            'nilai'        => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'                     => ':attribute wajib diisi.',
            'kode.unique'                  => 'Kode aset sudah digunakan.',
            'nilai.numeric'                => 'Nilai harus berupa angka.',
            'nilai.min'                    => 'Nilai tidak boleh kurang dari 0.',
            'category_id.exists'           => 'Kategori tidak valid.',
            'status.in'                    => 'Status tidak valid.',
            'tanggal_beli.date'            => 'Tanggal beli tidak valid.',
            'tanggal_beli.before_or_equal' => 'Tanggal beli tidak boleh di masa depan.',
        ];
    }

    public function attributes(): array
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
            'category_id' => 'Kategori',
            'lokasi' => 'Lokasi',
            'status' => 'Status',
            'tanggal_beli' => 'Tanggal beli',
            'nilai' => 'Nilai',
        ];
    }
}
