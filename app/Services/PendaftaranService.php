<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\StatusVerifikasiEnum;

class PendaftaranService
{

    public function buatPendaftaran(string $user_id, string $no_pendaftaran,string $jalur_pendaftaran_id) : Pendaftaran{
        return Pendaftaran::create([
            'user_id' => $user_id,
            'no_pendaftaran' => $no_pendaftaran,
            'diterima' => false,
            'jalur_pendaftaran_id' => $jalur_pendaftaran_id,
            'status_verifikasi' =>StatusVerifikasiEnum::BELUM_TERVERIFIKASI,
            'waktu_daftar' => now(),
        ]);
    }
    public function cetakFormulir( $kode_pendaftaran = null ){

    }
}
