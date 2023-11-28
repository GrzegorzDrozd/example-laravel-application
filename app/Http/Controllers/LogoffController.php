<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoffController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::logoutCurrentDevice();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
