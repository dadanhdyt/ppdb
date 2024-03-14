<?php

namespace App\Services;

use App\Models\DataPeserta;
use App\Models\Pendaftaran;

class DataPesertaService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function isi(Pendaftaran $pendaftaran, $data = [])
    {
        $data['pendaftaran_id'] = $pendaftaran->id;
        return DataPeserta::create($data);
    }
    public function edit(Pendaftaran $pendaftaran, $data = [])
    {
        $alamat = [];
        if (is_array($data['alamat'])) {
            foreach ($data['alamat'] as $key => $value) {
                $alamat[$key] = $value;
            }
            unset($data['alamat']);
        }
        $data = array_merge($data, $alamat);
        $pendaftaran = DataPeserta::where('pendaftaran_id', $pendaftaran->id)->update($data);
        return $pendaftaran;
    }
}
