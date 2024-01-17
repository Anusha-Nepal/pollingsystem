<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifyEmail;

class VerificationController extends Controller
{
    public function verifyEmail($token)
    {
        $verification = Verifyemail::where('token', $token)->first();

        if ($verification) {
            $user = $verification->user;
            $user->is_email_verified = true;
            $user->save();
            return redirect(route('auth.login'))->with('message', 'Email verified successfully. You can now log in.');

        }

        return redirect(route('auth.register'))->with('message', 'Invalid verification token.');
    }
}
