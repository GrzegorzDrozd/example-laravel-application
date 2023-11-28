<?php

namespace App\Http\Controllers\TermsAndConditions;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveTermsAndConditionsRequest;
use App\Models\Terms;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AcceptController extends Controller
{
    public function __invoke(ApproveTermsAndConditionsRequest $request): RedirectResponse
    {
        $request->validated();
        $validated = $request->safe();

        $user = User::find(session('user_id'));
        $terms = Terms::find($validated['id']);
        $user->terms()->save($terms);
        return redirect(route('login'));
    }
}
