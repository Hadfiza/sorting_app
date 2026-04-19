<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\PengumpulanPraktikum;
use App\Models\Praktikum;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $kelases = Kelas::all();

        return view('dosen.praktikum.index', compact('praktikum','kelases'));
    }

    public function show($id)
    {
        // 1. Asumsi pertama: ID yang dikirim dari URL adalah ID Aktivitas
        $item = \App\Models\Aktivitas::find($id);
        
        if ($item) {
            // Arahkan otomatis ke foldernya (Contoh: mahasiswa.bubble.praktikum)
            return view('mahasiswa.' . $item->folder . '.praktikum', compact('item'));
        }

        // 2. Fallback: Jika ID yang dikirim ternyata ID Praktikum (Logika lama)
        $praktikum = \App\Models\Praktikum::findOrFail($id);
        $item = $praktikum->aktivitas; // Ambil relasi aktivitasnya
        
        return view('mahasiswa.' . $item->folder . '.praktikum', compact('item', 'praktikum'));
    }
public function submit(Request $request)
    {
        $request->validate([
            'kode_program' => 'required',
            'penjelasan'   => 'required',
            'output' => 'required',
            'praktikum_id' => 'required'
        ]);

        try {
            $mahasiswa = auth()->user()->mahasiswa;
            
            if (!$mahasiswa) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Profil mahasiswa tidak ditemukan di database!'
                ], 404);
            }

            PengumpulanPraktikum::updateOrCreate(
            [
                'id_praktikum' => $request->praktikum_id,
                'id_mahasiswa' => $mahasiswa->id // <-- Menggunakan ID tabel mahasiswa
            ],
            [
                'kode_program'   => $request->kode_program,
                'output'         => $request->output,
                'penjelasan'     => $request->penjelasan,
                'status'         => 'submitted',
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
        // 1. Cari data pengumpulan yang SPESIFIK berdasarkan ID Pengumpulan yang diklik
        $item = PengumpulanPraktikum::with(['praktikum', 'mahasiswa.user', 'mahasiswa.kelas'])
                ->findOrFail($id);

        // 2. Ambil informasi praktikum (judul, dll) dari relasi data tersebut
        $praktikum = $item->praktikum;

        // 3. Bungkus $item ke dalam array agar file view show.blade.php 
        //    (yang menggunakan perulangan @foreach) tetap bisa berjalan normal tanpa error.
        $pengumpulan = [$item];

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

    // =====================================================================
    // FITUR DOSEN MENG-UPLOAD SOAL (PDF) & DESKRIPSI PRAKTIKUM
    // =====================================================================
    public function simpanSoal(Request $request, $id_aktivitas)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file_soal' => 'nullable|mimes:pdf|max:5120', // Wajib PDF, Max 5MB
        ]);

        $praktikum = Praktikum::firstOrNew(['id_aktivitas' => $id_aktivitas]);
        
        $praktikum->judul = $request->judul;
        $praktikum->deskripsi = $request->deskripsi;

        // Logika Upload File PDF (Menggunakan Disk Public Eksplisit)
        if ($request->hasFile('file_soal')) {
            // Hapus file lama jika ada
            if ($praktikum->file_soal && Storage::disk('public')->exists('soal_praktikum/' . $praktikum->file_soal)) {
                Storage::disk('public')->delete('soal_praktikum/' . $praktikum->file_soal);
            }

            // Simpan file baru dengan paksaan ke Disk Public
            $file = $request->file('file_soal');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Parameter ke-3 ('public') akan memaksa Laravel menaruhnya di storage/app/public
            $file->storeAs('soal_praktikum', $filename, 'public');

            $praktikum->file_soal = $filename;
        }

        $praktikum->save();

        return back()->with('success', 'Tugas Praktikum & File Soal berhasil disimpan.');
    }

    public function kelolaSoal()
    {
        // Mengambil semua aktivitas yang bertipe praktikum beserta data Praktikum-nya
        $aktivitas = Aktivitas::with('praktikum')
                        ->where('tipe', 'praktikum')
                        ->get();

        return view('dosen.praktikum.soal', compact('aktivitas'));
    }

}
