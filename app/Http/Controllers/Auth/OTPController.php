<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class OTPController extends Controller
{
    // Show OTP verification form
    public function index(Request $request)
    {
        return view('auth.verify-otp');
    }

    // Verify OTP
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $email = $request->session()->get('email');
        if (!$email) return redirect()->route('login')->with('error', 'Email not found in session.');

        $user = User::where('email', $email)->first();
        if (!$user) return redirect()->route('login')->with('error', 'User not found.');

        if ((string)$user->otp_code !== (string)$request->otp) {
            return back()->with('error', 'Invalid OTP.');
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'OTP expired.');
        }

        $user->is_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your account is verified!');
    }

    // Resend OTP
    public function resend(Request $request)
    {
        $email = $request->session()->get('email');
        if (!$email) return redirect()->route('login')->with('error', 'Email not found.');

        $user = User::where('email', $email)->first();
        if (!$user) return redirect()->route('login')->with('error', 'User not found.');

        $otp = rand(100000, 999999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new OTPMail($otp));

        return back()->with('success', 'A new OTP has been sent to your email.');
    }
}
