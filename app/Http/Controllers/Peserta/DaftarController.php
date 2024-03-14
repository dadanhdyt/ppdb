<?php

namespace App\Http\Controllers\Peserta;

use App\GlobalDataClass;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DataPesertaService;
use App\Services\PendaftaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DaftarController extends Controller
{
    public function getJalurPendaftaran()
    {
        return GlobalDataClass::getJalurPendaftaran();
    }
    public function __invoke()
    {
        return inertia('Peserta/Daftar', [
            'jalur_pendaftaran' => $this->getJalurPendaftaran(),
        ]);
    }
    public function store(
        Request $request,
        PendaftaranService $pendaftaranService,
        DataPesertaService $dataPesertaService
    ) {
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'email|required|unique:users,email',
            'nisn' => 'required|numeric|unique:data_pesertas,nisn',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'jalur_pendaftaran_id' => 'required',
            'password' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'email' => $validated['email'],
                'name' => $validated['nama'],
                'role' => 'peserta',
                'password' => Hash::make($validated['password'])
            ]);

            $no_pendaftaran = strtoupper("PPDB-" . date('Y') . "-" . rand() . "-" . uniqid());

            $pendaftaran = $pendaftaranService->buatPendaftaran(
                $user->id,
                $no_pendaftaran,
                $validated['jalur_pendaftaran_id']
            );
            $dataPesertaService->isi($pendaftaran, [
                'nama_lengkap' => $user->name,
                'jenis_kelamin' => $request->post('jenis_kelamin'),
                'nisn' => $request->post('nisn'),
                'no_telp_hp' => $request->post('no_telp'),
            ]);
            DB::commit();
            return redirect()->route('peserta.login')->withErrors([
                'success_daftar' => "Pendaftaran akun berhasil. Silahkan login untuk lengkapi data"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            die($th->getMessage());
        }
    }
}
