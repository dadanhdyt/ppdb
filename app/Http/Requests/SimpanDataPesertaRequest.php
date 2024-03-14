<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanDataPesertaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string',
            'nisn' => 'required|string|regex:/^\d{10}$/',
            'jenis_kelamin' => 'required|string|in:L,P',
            'tinggi_badan' => 'required|integer|min:0',
            'berat_badan' => 'required|integer|min:0',
            'penyakit_yang_pernah_diderita' => 'required|boolean',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
            'agama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat.nama_jalan' => 'required|string',
            'alamat.desa_kelurahan' => 'required|string',
            'alamat.kecamatan' => 'required|string',
            'alamat.kota_kabupaten' => 'required|string',
            'alamat.kode_pos' => 'required|string',
            'no_telp_hp' => 'required|string',
            'keterangan_no_telp_hp' => 'required|string',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara' => 'required|integer|min:0',
        ];
    }
}
