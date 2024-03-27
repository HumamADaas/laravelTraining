<?php

namespace App\Http\Controllers\QR;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;

class QRUsers extends Controller
{
    public function userEncryption()
    {
// data:image/png;base64, .........
//        $users = GenerateQrCode::fromArray([
//            new Seller('Salla'), // seller name
//            new TaxNumber('1234567891'), // seller tax number
//            new InvoiceDate('2021-07-12T14:25:09Z'), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
//            new InvoiceTotalAmount('100.00'), // invoice total amount
//            new InvoiceTaxAmount('15.00') // invoice tax amount
//            // TODO :: Support others tags
//        ])->render();

        // Get all users from your database
        $users = User::all();

        // Array to store generated QR code images
        $qrCodes = [];

        // Generate QR code for each user
        foreach ($users as $user) {
            // Generate QR code with user data
            $qrCode = GenerateQrCode::fromArray([
                new Seller($user->name), // Seller name (using user's name as an example)
                new TaxNumber($user->tax_number), // Seller tax number (assuming it's stored in the database)
                new InvoiceDate(now()->toIso8601String()), // Current date as the invoice date
                new InvoiceTotalAmount('100.00'), // Example invoice total amount
                new InvoiceTaxAmount('15.00'), // Example invoice tax amount
                // You can add more tags here if needed
            ])->render();

            // Store the generated QR code image
            $qrCodes[] = $qrCode;
        }
        return view('welcome', compact('qrCodes'));

// now you can inject the output to src of html img tag :)
// <img src="$displayQRCodeAsBase64" alt="QR Code" />
    }
}
