<?php

namespace App\Services;

use App\Models\DataPrestasi;

class PrestasiService
{
    public function getByPendaftaranId(string $getByPendaftaranId){
        return DataPrestasi::wherePendaftaranId($getByPendaftaranId)->get();
    }
    public function tambah($data) {
        return DataPrestasi::create($data);
    }
}
