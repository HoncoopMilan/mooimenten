<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendCustomerCode extends Mailable
{
    use Queueable, SerializesModels;

    public $customerCode;
    public $expireDateTime;
    public $expireTime;
    public $companyName;
    

    /**
     * Create a new message instance.
     */
    public function __construct($customerCode, $expireDateTime, $expireTime, $companyName)
    {
        $this->customerCode = $customerCode;
        $this->expireDateTime = $expireDateTime;
        $this->expireTime = $expireTime;
        $this->companyName = $companyName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {   
       
        return new Envelope(
            subject: 'Klantcode',
            from: new Address('jeffrey@example.com', $this->companyName),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customer-code',
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
