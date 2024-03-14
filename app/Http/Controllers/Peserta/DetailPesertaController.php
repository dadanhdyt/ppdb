<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Services\OrangTuaService;
use App\Services\PrestasiService;
use Illuminate\Http\Request;

class DetailPesertaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, OrangTuaService $orangTuaService, PrestasiService $prestasiService)
    {
        $pendaftaran = auth()->user()->pendaftaran;
        $data_orang_tua = $orangTuaService->getByPendaftaranID($pendaftaran->id);
        return inertia('Peserta/DetailPeserta',[
            'data_peserta' => $pendaftaran->dataPeserta,
            'data_orang_tua' => $data_orang_tua,
            'data_prestasi' => $prestasiService->getByPendaftaranId($pendaftaran->id),
        ]);
    }
}
