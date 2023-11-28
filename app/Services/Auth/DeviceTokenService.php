<?php

namespace App\Services\Auth;

use App\Exceptions\UnknownDevice;
use App\Models\User;
use App\Notifications\NewDevice;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class DeviceTokenService
{
    /**
     * @throws UnknownDevice
     */
    public function checkUser(User $user): bool
    {
        $token = Cookie::get('tkn');
        $device = $user->userDevices()->where('device_token', '=', $token)->first();
        if (!empty($token) && !empty($device)) {
            return true;
        }
        $token = $this->getToken();
        session(['user_id'=>$user->id]);
        $user->notify(
            new NewDevice(
                $user,
                URL::temporarySignedRoute(
                    'authorize_device',
                    now()->addMinutes(5),
                    [
                        'token'=>base64_encode($token)
                    ]
                )
            )
        );
        throw new UnknownDevice();
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return Hash::make(Str::random(60));
    }

    public function getTokenExpirationInMinutes(): int
    {
        // 60 * 24 * 31 = month in minutes
        return 44640;
    }
}
