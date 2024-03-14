<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Http\Requests\SimpanDataPesertaRequest;
use App\Services\DataPesertaService;
use Illuminate\Http\Request;

class DataPesertaController extends Controller
{
    public function edit(){
        $data_peserta = auth()->user()->pendaftaran->dataPeserta;
        return inertia('Peserta/EditDataPeserta');
    }
    public function simpan(Request $request, SimpanDataPesertaRequest $simpanDataPesertaRequest,DataPesertaService $dataPesertaService) {
       $validated = $simpanDataPesertaRequest->validated();

       $kode_pendaftaran = auth()->user()->pendaftaran;
       if($dataPesertaService->edit($kode_pendaftaran,$validated)) {
        return redirect()->back()->withErrors([
            'success_simpan' => "Data berhasil di simpan"
        ]);
       }
    }
}
