<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class OrderReceipt extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Order $order,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Your Order Receipt: {$this->order->order_number}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.receipt',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Generate the PDF invoice
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.print', [
            'order' => $this->order->load('orderItems'),
            'company' => [
                'name' => 'Makombero Branding',
                'address' => '123 Brand Street, Harare',
                'phone' => '+263 77 123 4567',
                'email' => 'info@makomberobranding.co.zw',
                'website' => 'www.makomberobranding.co.zw',
                'logo' => public_path('images/logo.png'),
            ],
            'date' => now()->format('d F, Y'),
        ]);

        return [
            Attachment::fromData(fn () => $pdf->output(), "invoice-{$this->order->order_number}.pdf")
                ->withMime('application/pdf'),
        ];
    }
}
