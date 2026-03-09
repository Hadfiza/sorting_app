<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanPraktikum;
use App\Models\Praktikum;
use Illuminate\Http\Request;

class PraktikumController extends Controller
{

    public function index()
    {
        $praktikum = \App\Models\PengumpulanPraktikum::with([
            'praktikum',
            'mahasiswa.user',
            'mahasiswa.kelas'
        ])->get();

        return view('dosen.praktikum.index', compact('praktikum'));
    }

    public function show($id)
    {
        $praktikum = Praktikum::findOrFail($id);
        return view('mahasiswa.praktikum', compact('praktikum'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'kode_program' => 'required',
            'penjelasan' => 'required',
            'praktikum_id' => 'required'
        ]);

        $idMahasiswa = auth()->user()->mahasiswa->id;

        PengumpulanPraktikum::updateOrCreate(
        [
            'id_praktikum' => $request->praktikum_id,
            'id_mahasiswa' => $idMahasiswa
        ],
        [
            'kode_program' => $request->kode_program,
            'output' => $request->output,
            'penjelasan' => $request->penjelasan,
            'status' => 'submitted'
        ]);

        return response()->json(['success' => true]);
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
