<?php

namespace App\Http\Controllers;

use App\Mail\OtpMailer;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
       // Mail::mailer('mailtrap')->to('ruthikaputhran@gmail.com')->send(new OtpMailer("Jon"));
      //  Mail::to('ruthikaputhran@gmail.com')->send(new OtpMailer("Ruthika"));

        try {
            Mail::to('ruthikaputhran@gmail.com')->send(new OtpMailer("Ruthika"));
            // Email sent successfully
        } catch (\Exception $e) {
            // Handle the exception
            \Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json(['error' => 'Email sending failed'], 500);
        }
    }
}

