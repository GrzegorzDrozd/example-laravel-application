<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendAccountActivationMessage extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('home')->with('status', 'Activation email sent');
    }
}
