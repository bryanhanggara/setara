<?php

namespace App\Console\Commands;

use App\Models\Newsletter;
use App\Models\News;
use App\Models\SastraTulis;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterUpdate;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send {--type=weekly}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter to all active subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->option('type');
        $subscribers = Newsletter::active()->get();
        
        if ($subscribers->isEmpty()) {
            $this->info('Tidak ada subscriber aktif.');
            return;
        }

        // Ambil konten terbaru
        $latestNews = News::where('status', 'published')
                          ->latest()
                          ->take(5)
                          ->get();
        
        $latestSastra = SastraTulis::where('status', 'PUBLISHED')
                                   ->latest()
                                   ->take(5)
                                   ->get();

        $this->info("Mengirim newsletter {$type} ke {$subscribers->count()} subscriber...");

        $bar = $this->output->createProgressBar($subscribers->count());
        $bar->start();

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterUpdate($subscriber, $latestNews, $latestSastra, $type));
                $bar->advance();
            } catch (\Exception $e) {
                $this->error("Gagal kirim ke {$subscriber->email}: " . $e->getMessage());
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info('Newsletter berhasil dikirim!');
    }
}
