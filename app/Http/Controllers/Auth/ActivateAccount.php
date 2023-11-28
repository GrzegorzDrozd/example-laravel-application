<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Listeners\AccountActivated;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class ActivateAccount extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // mark account as activated
        $request->fulfill();
        event(new AccountActivated());
        return redirect('/home');
    }
}
