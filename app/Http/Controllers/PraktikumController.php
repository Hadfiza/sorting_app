<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanPraktikum;
use App\Models\Praktikum;
use Illuminate\Http\Request;

class PraktikumController extends Controller
{

    public function index(Request $request)
    {
        $query = PengumpulanPraktikum::with([
            'praktikum',
            'mahasiswa.user',
            'mahasiswa.kelas'
        ]);

        // Filter pencarian nama mahasiswa
        if ($request->filled('search')) {
            $query->whereHas('mahasiswa.user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas_id')) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('id_kelas', $request->kelas_id);
            });
        }

        $praktikum = $query->get();

        // Ambil daftar kelas untuk dropdown
        $kelases = \App\Models\Kelas::all();

        return view('dosen.praktikum.index', compact('praktikum','kelases'));
    }

    public function show($id)
    {
        $praktikum = Praktikum::findOrFail($id);
        return view('mahasiswa.praktikum', compact('praktikum'));
    }

public function submit(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'kode_program' => 'required',
            'penjelasan'   => 'required',
            'praktikum_id' => 'required'
        ]);

        try {
            // 2. Ambil profil Mahasiswa (Bukan User)
            $mahasiswa = auth()->user()->mahasiswa;
            
            if (!$mahasiswa) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Profil mahasiswa tidak ditemukan di database!'
                ], 404);
            }

            // 3. Simpan ke database menggunakan ID MAHASISWA (Kembali seperti awal)
            \App\Models\PengumpulanPraktikum::updateOrCreate(
            [
                'id_praktikum' => $request->praktikum_id,
                'id_mahasiswa' => $mahasiswa->id // <-- KEMBALI MENGGUNAKAN $mahasiswa->id
            ],
            [
                'kode_program'   => $request->kode_program,
                'output'         => $request->output ?? '-',
                'penjelasan'     => $request->penjelasan,
                'status'         => 'submitted',
                
                // Beri nilai null agar aman dari error
                'nilai'          => null, 
                'feedback_dosen' => null  
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sistem Error: ' . $e->getMessage()
            ], 500);
        }
    }

    //Halaman Dosen
    public function dosenShow($id)
    {
        $praktikum = \App\Models\Praktikum::findOrFail($id);

        $pengumpulan = \App\Models\PengumpulanPraktikum::where('id_praktikum', $id)
            ->with('mahasiswa')
            ->get();

        return view('dosen.praktikum.show', compact('praktikum', 'pengumpulan'));
    }

    public function beriNilai(Request $request)
    {
        $data = PengumpulanPraktikum::findOrFail($request->id);

        $data->update([
            'nilai' => $request->nilai,
            'feedback_dosen' => $request->feedback_dosen,
            'status' => 'dinilai'
        ]);

        return back()->with('success','Nilai berhasil disimpan');
    }

    public function update(Request $request, $id)
{
    // 1. Validasi input
    $request->validate([
        'nilai' => 'required|numeric|min:0|max:100',
        'feedback' => 'nullable|string'
    ]);

    try {
        // 2. Cari data praktikum mahasiswa berdasarkan ID
        $data = PengumpulanPraktikum::findOrFail($id);

        // 3. Update data
        $data->update([
            'nilai' => $request->nilai,
            'feedback_dosen' => $request->feedback,
            'status' => 'dinilai' // Opsional: jika Anda punya kolom status
        ]);

        // 4. Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Nilai dan feedback untuk ' . $data->mahasiswa->user->nama . ' berhasil disimpan.');
        
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['msg' => 'Gagal menyimpan data.']);
    }
}

}
