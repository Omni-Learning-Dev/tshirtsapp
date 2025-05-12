<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Generate and display a printable invoice for an order
     */
    public function print(Order $order)
    {
        // Load order items relationship
        $order->load('orderItems');

        // Add company details or load from settings
        $companyDetails = [
            'name' => 'Makombero Branding',
            'address' => '123 Brand Street, Harare',
            'phone' => '+263 77 123 4567',
            'email' => 'info@makomberobranding.co.zw',
            'website' => 'www.makomberobranding.co.zw',
            'logo' => public_path('images/logo.png'),
        ];

        // Generate the PDF invoice
        $pdf = PDF::loadView('invoices.print', [
            'order' => $order,
            'company' => $companyDetails,
            'date' => Carbon::now()->format('d F, Y'),
        ]);

        // Download or stream the PDF
        return $pdf->stream("invoice-{$order->order_number}.pdf");
    }

    /**
     * Download an invoice for an order
     */
    public function download(Order $order)
    {
        // Load order items relationship
        $order->load('orderItems');

        // Add company details or load from settings
        $companyDetails = [
            'name' => 'Makombero Branding',
            'address' => '123 Brand Street, Harare',
            'phone' => '+263 77 123 4567',
            'email' => 'info@makomberobranding.co.zw',
            'website' => 'www.makomberobranding.co.zw',
            'logo' => public_path('images/logo.png'),
        ];

        // Generate the PDF invoice
        $pdf = PDF::loadView('invoices.print', [
            'order' => $order,
            'company' => $companyDetails,
            'date' => Carbon::now()->format('d F, Y'),
        ]);

        // Download the PDF
        return $pdf->download("invoice-{$order->order_number}.pdf");
    }
}
