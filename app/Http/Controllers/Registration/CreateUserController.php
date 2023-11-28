<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\Terms;
use App\Models\User;
use App\Services\Auth\DeviceTokenService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class CreateUserController extends Controller
{
    public function __construct(protected DeviceTokenService $deviceTokenService) {

    }

    public function __invoke(CreateUserRequest $request): RedirectResponse
    {
        $request->validated();
        $validated = $request->safe();

        DB::beginTransaction();
        try {
            $user = new User([
                'name'     => $validated['username'],
                'password' => $validated['password'],
                'email'    => $validated['email']
            ]);

            $deviceToken = $this->deviceTokenService->getToken();
            $user->save();
            $user->userDevices()->create([
                'device_token' => $deviceToken,
            ]);

            $approvedTerms = Terms::find($validated['terms']);

            $user->terms()->save($approvedTerms);

            $user->save();
            DB::commit();
            Auth::login($user);
            event(new Registered($user));
            $resp = new RedirectResponse(route('home'));
            $resp->withCookie(cookie(
                'tkn',
                $deviceToken,
                $this->deviceTokenService->getTokenExpirationInMinutes()
            ));
        } catch (RuntimeException $e) {
            DB::rollBack();
            $resp = new RedirectResponse(route('register'));
            $resp->withErrors(['error'=>'Unable to create account.']);
        } catch (Exception $e) {
            DB::rollBack();
            $resp = new RedirectResponse(route('register'));
            $resp->withErrors(['error'=>'Unable to create account. Unknown error.']);
        }
        return $resp;
    }
}
