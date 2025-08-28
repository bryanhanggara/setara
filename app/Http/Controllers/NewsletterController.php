<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterWelcome;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar di newsletter'
        ]);

        try {
            $newsletter = Newsletter::create([
                'email' => $request->email,
                'is_active' => true,
                'subscribed_at' => now()
            ]);

            // Kirim email welcome
            Mail::to($request->email)->send(new NewsletterWelcome($newsletter));

            return back()->with('success', 'Terima kasih! Anda berhasil berlangganan newsletter kami.');
        } catch (\Exception $e) {
            return back()->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function unsubscribe($email)
    {
        $newsletter = Newsletter::where('email', $email)->first();
        
        if ($newsletter) {
            $newsletter->update(['is_active' => false]);
            return back()->with('success', 'Anda berhasil berhenti berlangganan newsletter.');
        }

        return back()->with('error', 'Email tidak ditemukan.');
    }
}
