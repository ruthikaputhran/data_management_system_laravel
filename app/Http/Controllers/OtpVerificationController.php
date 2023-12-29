<?php

namespace App\Http\Controllers;

// app/Http/Controllers/OtpVerificationController.php

use Illuminate\Http\Request;


class OtpVerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = auth()->user();

        // Check if the OTP is valid
        if ($user->otp_secret == $request->otp) {
            // OTP is valid, log in the user
            auth()->login($user);

            // Clear the OTP secret
            $user->update(['otp_secret' => null]);

            // Redirect to the dashboard or any desired page
            return redirect()->route('dashboard');
        }

        // Invalid OTP, redirect back to the verification page
        return redirect()->route('otp.verify')->withErrors(['otp' => 'Invalid OTP']);
    }
}
