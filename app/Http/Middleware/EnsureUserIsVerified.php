<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_verified) {
            // Log out user
            Auth::logout();

            // Store email in session to resend OTP
            $request->session()->put('email', $request->email);

            return redirect()->route('otp.verify.page')
                             ->with('error', 'You must verify your email before logging in.');
        }

        return $next($request);
    }
}
