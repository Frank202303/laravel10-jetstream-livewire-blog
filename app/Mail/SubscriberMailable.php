<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
/// When a user subscribes, send an email to the user
// Copy to '517277381@qq.com'【admin】
class SubscriberMailable extends Mailable
{
    public $data;

    //Because Queueable is used, you need to run php artisan queue:work on the command line
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($formData)
    {
        // Pass formData data to SubscriberMailable's $this->data in the constructor
        $this->data = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Sender and Name
            from: new Address('517277381@qq.com', 'YiMDXian'),
            // Subject/title of the email
            subject: 'Thank you',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.subscriber-mail',
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
