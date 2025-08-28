<?php

namespace App\Mail;

use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter;
    public $latestNews;
    public $latestSastra;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct(Newsletter $newsletter, $latestNews, $latestSastra, $type = 'weekly')
    {
        $this->newsletter = $newsletter;
        $this->latestNews = $latestNews;
        $this->latestSastra = $latestSastra;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->type === 'weekly' ? '📰 Newsletter Mingguan SETARA' : '📰 Update Terbaru SETARA';
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter.update',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
