<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\DataPrestasi;
use App\Services\PrestasiService;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataPrestasiController extends Controller
{
    public function __construct(
        public readonly UploadFileService $uploadFileService,
        public readonly PrestasiService $prestasiService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PrestasiService $prestasiService)
    {
        $pendaftaran_id = Auth::user()->pendaftaran->id;
        $prestasi = $prestasiService->getByPendaftaranId($pendaftaran_id);

        return inertia('Peserta/DataPrestasi', [
            'prestasi' => $prestasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Peserta/Prestasi/TambahBaru');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'jenis_perlombaan' => 'required|string|max:255',
            'lingkup' => 'required|string|max:255',
            'perinkat' => 'required|string|max:255',
            'file_sertifikat' => 'nullable|mimes:pdf',
        ]);
        $filename = null;
        if ($validated['file_sertifikat']) {
            $filename = $this->uploadFileService->uploadSertifikat($validated['file_sertifikat'], Str::slug($validated['nama'] . ' sertifikat') . Str::uuid());
        }
        $validated['file_sertifikat'] = $filename;
        $validated['pendaftaran_id'] = auth()->user()->pendaftaran->id;

        $this->prestasiService->tambah($validated);

        return redirect()->route('peserta.data-prestasi.index')->withErrors([
            'success' => 'Data prestasi berhasil di tambahkan',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataPrestasi = DataPrestasi::find($id);
        if (!Gate::allows('update_data_prestasi', $dataPrestasi)) {
            return abort(403);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'jenis_perlombaan' => 'required|string|max:255',
            'lingkup' => 'required|string|max:255',
            'perinkat' => 'required|string|max:255',
            'file_sertifikat' => 'nullable|mimes:pdf',
        ]);
        $old_filename = $dataPrestasi->file_sertifikat ?? '';

        if ($file = $request->file('file_sertifikat')) {
            $filename = $this->uploadFileService->uploadSertifikat($file, Str::slug($validated['nama'] . ' sertifikat') . Str::uuid());
            $validated['file_sertifikat'] = $filename;
        }
        if ($dataPrestasi->update($validated)) {
            if ($request->file('file_sertifikat') && Storage::disk('public')->exists($old_filename)) {
                Storage::disk('public')->delete($old_filename);
            }
            return redirect()->route('peserta.data-prestasi.index')->withErrors([
                'success' => 'Data prestasi berhasil di update',
            ]);
        }
        return redirect()->route('peserta.data-prestasi.index')->withErrors([
            'success' => 'Data prestasi gagal di update',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataPrestasi::find($id)->delete();

        return redirect()->back()->withErrors([
            'success' => 'Data berhasil di hapus',
        ]);
    }
}
