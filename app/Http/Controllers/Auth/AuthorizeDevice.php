<?php

namespace App\Http\Controllers\Auth;

use App\Events\DeviceAuthorizedSuccessfully;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDevice;
use App\Services\Auth\DeviceTokenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorizeDevice extends Controller
{

    public function __construct(protected DeviceTokenService $deviceTokenService)
    {}

    public function __invoke(Request $request, string $token): RedirectResponse
    {
        $userid = $request->session()->get('user_id', false);
        $user = User::find($userid);
        if (empty($userid)) {
            return redirect(route('login'))->with(
                'error',
                'You must use activation link only on a device you are trying to activate'
            );
        }
        $userDevice = new UserDevice([
            'device_token' => base64_decode($token),
            'last_login_at'=> now(),
            'user_id' => $userid,
        ]);
        $userDevice->save();
        event(new DeviceAuthorizedSuccessfully($user));
        return redirect(route('login'))->withCookie(
            cookie(
                'tkn',
                base64_decode($token),
                $this->deviceTokenService->getTokenExpirationInMinutes()
            )
        );
    }
}
