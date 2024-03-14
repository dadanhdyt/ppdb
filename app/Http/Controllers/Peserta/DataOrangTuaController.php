<?php

namespace App\Http\Controllers\Peserta;

use App\Exceptions\GagalMengimpanDataException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SimpanDataOrangTuaRequest;
use App\Services\OrangTuaService;
use Illuminate\Http\Request;

class DataOrangTuaController extends Controller
{
    public function edit(OrangTuaService $orangTuaService)
    {
        $pendaftaran_id = auth()->user()->pendaftaran->id;
        $dataOrangTua = $orangTuaService->getByPendaftaranID($pendaftaran_id);
        return inertia('Peserta/DataOrangTua', compact('dataOrangTua'));
    }
    public function simpan(
        Request $request,
        SimpanDataOrangTuaRequest $simpanDataOrangTuaRequest,
        OrangTuaService $orangTuaService
    ) {
        $dataOrangTua =  $simpanDataOrangTuaRequest->validated();
        $pendaftaran_id = auth()->user()->pendaftaran->id;
        try{

            $orangTuaService->simpan($pendaftaran_id, $dataOrangTua);
            return redirect()->back()->withErrors([
                'success_simpan' => "Berhasil menyimpan data orang tua!"
            ]);
        }catch(GagalMengimpanDataException $e){
            error_log($e->getMessage());
            return redirect()->back()->withErrors([
                'error' => "Gagal Mengimpan data"
            ]);
        }
    }
}
