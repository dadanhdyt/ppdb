<?php

namespace App\Services;

use App\Exceptions\GagalMengimpanDataException;
use App\Models\DataOrangTua;

class OrangTuaService
{
    public function simpan($pendaftaran_id, $data)
    {
        $dataOrangTua = [];
        try {
            foreach ($data as $key => $value) {
                $value['type'] = $key;
                $value['pendaftaran_id'] = $pendaftaran_id;
                $dataOrangTua[] = $value;
                $cek = DataOrangTua::where('type', $key)->where('pendaftaran_id', $pendaftaran_id)->first();
                if (!$cek) {
                    DataOrangTua::create($value);
                } else {
                    $cek->update($value);
                }
            }
        } catch (\Throwable $th) {
            throw new GagalMengimpanDataException($th->getMessage());
        }
    }

    public function getByPendaftaranID($pendaftaran_id)
    {
        $orangTua = DataOrangTua::where('pendaftaran_id', $pendaftaran_id)->limit(3)->get();
        $dataOrangTua = [];
        foreach ($orangTua as $value) {
            $dataOrangTua[$value->type] = $value;
        }

        return $dataOrangTua;
    }
}
