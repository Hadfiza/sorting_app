<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PasswordResetController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman form di browser
    public function showLupaPasswordForm()
    {
        return view('auth.lupa_password'); 
    }

    // 2. Fungsi untuk mengirim email via Brevo API
    public function kirimLinkReset(Request $request)
    {
        // Validasi pastikan email ada di database
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email ini tidak terdaftar di sistem kami.'
        ]);

        // Buat token unik
        $token = Str::random(64);

        // Simpan token ke tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Merakit isi surat email dari folder emails
        $htmlContent = view('emails.lupa_password', [
            'token' => $token,
            'email' => $request->email
        ])->render();

        // Mengirimkan email lewat jalur API Brevo
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => env('BREVO_API_KEY'),
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => 'SortLearn',
                'email' => 'hadfizaiza@gmail.com' // GANTI DENGAN EMAIL BREVO ANDA
            ],
            'to' => [
                ['email' => $request->email]
            ],
            'subject' => 'Reset Password Akun SortLearn',
            'htmlContent' => $htmlContent
        ]);

if ($response->successful()) {
            return back()->with('success', 'Kami telah mengirimkan link reset password ke email Anda!');
        } else {
            // Kode di bawah ini akan memaksa Brevo membocorkan alasan aslinya
            return back()->with('error', 'Gagal mengirim email: ' . $response->body());
        }
    }
}