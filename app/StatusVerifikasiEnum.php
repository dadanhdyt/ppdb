<?php

namespace App;

enum StatusVerifikasiEnum : string
{
    case TERVERIFIKASI = 'Terverifikasi';
    case BELUM_TERVERIFIKASI = 'Belum Terverifikasi';
    case DITOLAK = 'Ditolak';
    case DALAM_PROSESS = 'Dalam Proses';
    case DIPROSESS = 'Diproses';
    case DITUNDA = 'Ditunda';
    case SELESAI = 'Selesai';
    case GAGAL = 'Gagal';
}
