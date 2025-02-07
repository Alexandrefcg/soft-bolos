<?php

namespace App\Mail;

use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CakeAvailableMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(private string $url)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bolo disponivel',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.cake_available'
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
