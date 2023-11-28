<?php

namespace App\Http\Controllers\PasswordRecovery;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetNewPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    public function __invoke(SetNewPasswordRequest $request)
    {
        $request->validated();
        $validated = $request->safe(['email', 'password', 'password_confirmation', 'token']);

        $status = Password::reset(
            $validated,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }
        return back()->withErrors(['email' => [__($status)]]);
    }
}
