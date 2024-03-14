<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\StatusVerifikasiEnum;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $statusVerifikasi = auth()->user()->pendaftaran->status_verifikasi;
        $msg = match ($statusVerifikasi) {
            StatusVerifikasiEnum::TERVERIFIKASI => 'Data atau informasi telah melewati proses verifikasi dan dianggap valid atau sah.',
            StatusVerifikasiEnum::DALAM_PROSESS => 'Data atau informasi sedang dalam proses verifikasi. Ini menunjukkan bahwa proses verifikasi sedang berlangsung dan belum selesai.',
            StatusVerifikasiEnum::BELUM_TERVERIFIKASI => 'Data atau informasi belum melewati proses verifikasi atau belum diverifikasi. Status ini menunjukkan bahwa proses verifikasi belum dilakukan.',
            StatusVerifikasiEnum::DIPROSESS => 'Data atau informasi sedang dalam tahap diproses, mungkin setelah melewati verifikasi awal atau tahap-tahap sebelumnya.',
            StatusVerifikasiEnum::DITOLAK => 'Data atau informasi ditolak setelah melewati proses verifikasi. Ini mungkin disebabkan oleh ketidaksesuaian atau kesalahan dalam data yang diberikan. Silahkan periksa pesan di menu pesan, untuk melihat detail keterangan nya',
            StatusVerifikasiEnum::DITUNDA => 'Proses verifikasi atau pemrosesan data ditunda untuk sementara waktu, mungkin karena kekurangan informasi atau alasan lainnya.',
            StatusVerifikasiEnum::SELESAI => 'Proses verifikasi telah selesai dan data atau informasi dianggap sah atau valid.',
            StatusVerifikasiEnum::GAGAL => 'Proses verifikasi gagal atau tidak berhasil. Ini menunjukkan bahwa data atau informasi tidak dapat diverifikasi atau tidak valid',
        };
        return inertia("Peserta/Dashboard", [
            'status_verifikasi' => [
                'status' => $statusVerifikasi,
                'msg' => $msg,
            ]
        ]);
    }
}
