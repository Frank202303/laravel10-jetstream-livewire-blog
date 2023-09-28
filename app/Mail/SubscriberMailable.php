<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
/// 当用户订阅时，发送 邮件给用户
// 抄送 给 '517277381@qq.com'【admin】
class SubscriberMailable extends Mailable
{
    public $data;

    //因为使用了Queueable，所以要在命令行运行  php artisan queue:work
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($formData)
    {
        // 在构造函数里把formData 数据传给 SubscriberMailable的 $this->data
        $this->data = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // 发件人 及  名字
            from: new Address('517277381@qq.com', 'YiMDXian'),
            // 邮件 的 主题/title
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
