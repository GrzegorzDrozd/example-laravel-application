<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use App\Services\Auth\TermsAndConditionService;
use Illuminate\Contracts\View\View;

class RegisterFormController extends Controller
{
    public function __construct(protected TermsAndConditionService $termsAndConditionService) {

    }

    public function __invoke(): View
    {
        $terms = $this->termsAndConditionService->getCurrentTermsAndConditions();

        return view('register.form', ['terms'=>$terms->getKey()]);
    }
}
