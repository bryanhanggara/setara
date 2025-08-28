<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'email:test {email}';
    protected $description = 'Test email configuration';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing email configuration...");
        $this->info("Sending test email to: {$email}");
        
        try {
            Mail::raw('Test email dari SETARA! Email configuration berhasil.', function($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email Configuration - SETARA');
            });
            
            $this->info('✅ Email berhasil dikirim!');
            $this->info('Konfigurasi email sudah benar.');
            
        } catch (\Exception $e) {
            $this->error('❌ Gagal kirim email:');
            $this->error($e->getMessage());
            $this->info('');
            $this->info('Tips troubleshooting:');
            $this->info('1. Pastikan .env sudah benar');
            $this->info('2. Untuk Gmail: aktifkan 2FA dan buat App Password');
            $this->info('3. Untuk Mailtrap: copy credentials dari dashboard');
        }
    }
} 