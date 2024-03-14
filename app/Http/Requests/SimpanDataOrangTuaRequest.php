<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanDataOrangTuaRequest extends FormRequest
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
            'ayah.nama' => 'required|string',
            'ayah.nik' => 'required|string',
            'ayah.status' => 'required|string',
            'ayah.agama' => 'required|string',
            'ayah.tempat_lahir' => 'required|string',
            'ayah.tanggal_lahir' => 'required|date',
            'ayah.pendidikan_terakhir' => 'required|string',
            'ayah.pekerjaan' => 'required|string',
            'ayah.penghasilan' => 'required|string',
            'ayah.alamat' => 'required|string',

            'ibu.nama' => 'required|string',
            'ibu.nik' => 'required|string',
            'ibu.status' => 'required|string',
            'ibu.agama' => 'required|string',
            'ibu.tempat_lahir' => 'required|string',
            'ibu.tanggal_lahir' => 'required|date',
            'ibu.pendidikan_terakhir' => 'required|string',
            'ibu.pekerjaan' => 'required|string',
            'ibu.penghasilan' => 'required|string',
            'ibu.alamat' => 'required|string',

            'wali.nama' => 'nullable|string',
            'wali.nik' => 'nullable|string',
            'wali.status' => 'nullable|string',
            'wali.agama' => 'nullable|string',
            'wali.tempat_lahir' => 'nullable|string',
            'wali.tanggal_lahir' => 'nullable|date',
            'wali.pendidikan_terakhir' => 'nullable|string',
            'wali.pekerjaan' => 'nullable|string',
            'wali.penghasilan' => 'nullable|string',
            'wali.alamat' => 'nullable|string',
        ];
    }
    public function messages(){
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'date' => 'Format tanggal pada kolom :attribute tidak valid.',
        ];
    }
    public function attributes(){
        return [
            'ayah.nama' => 'Nama Ayah',
            'ayah.nik' => 'NIK Ayah',
            'ayah.status' => 'Status Ayah',
            'ayah.agama' => 'Agama Ayah',
            'ayah.tempat_lahir' => 'Tempat Lahir Ayah',
            'ayah.tanggal_lahir' => 'Tanggal Lahir Ayah',
            'ayah.pendidikan_terakhir' => 'Pendidikan Terakhir Ayah',
            'ayah.pekerjaan' => 'Pekerjaan Ayah',
            'ayah.penghasilan' => 'Penghasilan Ayah',
            'ayah.alamat' => 'Alamat Ayah',

            'ibu.nama' => 'Nama Ibu',
            'ibu.nik' => 'NIK Ibu',
            'ibu.status' => 'Status Ibu',
            'ibu.agama' => 'Agama Ibu',
            'ibu.tempat_lahir' => 'Tempat Lahir Ibu',
            'ibu.tanggal_lahir' => 'Tanggal Lahir Ibu',
            'ibu.pendidikan_terakhir' => 'Pendidikan Terakhir Ibu',
            'ibu.pekerjaan' => 'Pekerjaan Ibu',
            'ibu.penghasilan' => 'Penghasilan Ibu',
            'ibu.alamat' => 'Alamat Ibu',

            'wali.nama' => 'Nama Wali',
            'wali.nik' => 'NIK Wali',
            'wali.status' => 'Status Wali',
            'wali.agama' => 'Agama Wali',
            'wali.tempat_lahir' => 'Tempat Lahir Wali',
            'wali.tanggal_lahir' => 'Tanggal Lahir Wali',
            'wali.pendidikan_terakhir' => 'Pendidikan Terakhir Wali',
            'wali.pekerjaan' => 'Pekerjaan Wali',
            'wali.penghasilan' => 'Penghasilan Wali',
            'wali.alamat' => 'Alamat Wali',
        ];
    }
}
