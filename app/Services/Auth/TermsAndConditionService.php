<?php

namespace App\Services\Auth;

use App\Exceptions\TermsAndConditionsNotApproved;
use App\Models\Terms;
use App\Models\User;

class TermsAndConditionService
{
    /**
     * @throws TermsAndConditionsNotApproved
     */
    public function checkUser(User $user): bool {
        $latestApprovedTermsId = $user->getLatestApprovedTermsAndConditionsId();
        $currentTermsId = $this->getCurrentTermsAndConditions()->getKey();
        if ($latestApprovedTermsId !== $currentTermsId) {
            session(['user_id'=>$user->getKey()]);
            throw new TermsAndConditionsNotApproved();
        }
        return true;
    }

    /**
     * @return mixed
     * @todo make it better: add `active` column or something
     */
    public function getCurrentTermsAndConditions(): Terms
    {
        return Terms::where('required_from', '<', new \DateTime())->orderBy('required_from', 'desc')->first();
    }
}
