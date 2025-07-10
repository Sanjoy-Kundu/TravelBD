<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerDetailsChange extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $customer;
    public $changeFieldName;
    public $newValue;
    public function __construct($customer, $changeFieldName, $newValue)
    {
        $this->customer = $customer;
        $this->changeFieldName = $changeFieldName;
        $this->newValue = $newValue;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Customer Details Change',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.customer.customerDetailsChange',
             with: [
            'customer' => $this->customer,
            'changeFieldName' => $this->changeFieldName,  // ✅ correct key
            'newValue' => $this->newValue
        ]
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
