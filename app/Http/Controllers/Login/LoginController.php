<?php

namespace App\Http\Controllers\Login;

use App\Exceptions\TermsAndConditionsNotApproved;
use App\Exceptions\UnknownDevice;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Services\Auth\DeviceTokenService;
use App\Services\Auth\TermsAndConditionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(
        protected DeviceTokenService $deviceTokenService,
        protected TermsAndConditionService $termsAndConditionService
    ){}

    public function __invoke(LoginUserRequest $request): RedirectResponse
    {
        $request->validated();
        $validated = $request->safe();
        try {
            if (Auth::attemptWhen($validated->toArray(), [
                [$this->termsAndConditionService, 'checkUser'],
                [$this->deviceTokenService, 'checkUser'],
            ])) {
                $request->session()->regenerate();

                return redirect()->route('home');
            }
        } catch (UnknownDevice $e) {
            return redirect(route('authorize_device_prompt'))->onlyInput('email');

        } catch (TermsAndConditionsNotApproved $e) {
            return redirect(route('view_updated_terms_and_conditions'))->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
