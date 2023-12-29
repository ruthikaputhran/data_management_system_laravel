<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\EmailHeader\CustomVariableHeader;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

class WelcomeMailer extends Mailable
{
    use Queueable, SerializesModels;

    private string $name;
    private string $email;
    private string $password;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email,$password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                env('MAIL_FROM_ADDRESS', 'ruthika.puthran@gmail.com'),
                env('MAIL_FROM_NAME', 'Data Management Portal')
            ),
            subject: 'Welcome to the portal',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'welcome-email',
            with: ['name' => $this->name,'email' => $this->email,'password' => $this->password],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
          
        ];
    }
}