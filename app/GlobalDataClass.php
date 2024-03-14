<?php

namespace App;

use App\Models\JalurPendaftaran;

class GlobalDataClass
{
    public static function getAgama()
    {
        return [
            'Islam',
            'Kristen',
            'Katholik',
            'Hindu',
            'Buddha',
            'Kong Hu Cu'
        ];
    }
    public static function getJalurPendaftaran(){
        return JalurPendaftaran::all();
    }
    public static function getPekerjaan()
    {
        return  [
            "Guru",
            "Dokter",
            "Perawat",
            "Pengusaha",
            "PNS (Pegawai Negeri Sipil)",
            "Karyawan Swasta",
            "Wiraswasta",
            "Petani",
            "Nelayan",
            "Buruh",
            "Penyiar Radio atau TV",
            "Seniman",
            "Tukang Masak",
            "Penjual Makanan",
            "Tukang Bangunan",
            "Supir",
            "Penjahit",
            "Desainer Grafis",
            "Programmer",
            "Analyst",
            "Ibu Rumah Tangga",
            "Tidak Bekerja",
        ];
    }
}
