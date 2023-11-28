<?php

namespace App\Http\Controllers\TermsAndConditions;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use App\Services\Auth\TermsAndConditionService;

class ViewController extends Controller
{
    public function __construct(protected TermsAndConditionService $termsAndConditionService) {

    }

    public function view()
    {
        $terms = $this->termsAndConditionService->getCurrentTermsAndConditions();

        return view('terms.view', [
            'terms' => $terms ?? ['content'=>'not found']
        ]);
    }

    public function preview()
    {
        $terms = $this->termsAndConditionService->getCurrentTermsAndConditions();

        return view('terms.preview', [
            'terms' => $terms ?? ['content'=>'not found']
        ]);
    }
}
