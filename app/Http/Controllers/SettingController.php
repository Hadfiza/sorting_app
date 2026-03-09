<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'kkm_quiz' => 'required|integer|min:0|max:100',
            'kkm_evaluasi' => 'required|integer|min:0|max:100',
        ]);

        Setting::updateOrCreate(
            ['id_dosen' => auth()->user()->dosen->id],
            [
                'kkm_quiz' => $request->kkm_quiz,
                'kkm_evaluasi' => $request->kkm_evaluasi,
            ]
        );

        return back()->with('success','KKM berhasil diperbarui');
    }
}
