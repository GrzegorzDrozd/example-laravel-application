<?php

namespace App\Http\Controllers\PasswordRecovery;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;

class FormController extends Controller
{
    public function __invoke(PasswordResetRequest $request)
    {
        $request->validated();
        $validated = $request->safe();

        $status = Password::sendResetLink(
            $validated->only('email')
        );

        switch ($status){
            case PasswordBroker::INVALID_USER:
                // we don't want to say that user does not exist.
                $resp = back()->with(['status' => __(PasswordBroker::RESET_LINK_SENT)]);
                break;
            // @todo add other cases

            default:
                $resp = back()->with(['status' => __(Password::RESET_LINK_SENT)]);
                break;

        }

        return $resp;
    }
}
