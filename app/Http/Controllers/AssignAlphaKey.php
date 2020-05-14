<?php

namespace App\Http\Controllers;

use App\AlphaKey;
use App\AlphaSignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;

class AssignAlphaKey extends Controller
{
    public function __invoke(AlphaSignUp $alphaSignUp)
    {
        $this->authorize('create', [new AlphaKey, $alphaSignUp]);

        /** @var AlphaKey $alphaKey */
        $alphaKey = $alphaSignUp->alphaKeys()->create([
            'recipient_email' => $alphaSignUp->email,
            'recipient_user_id' => $alphaSignUp->user_id,
            'assigned_by' => Auth::id(),
            'key' => AlphaKey::generateKey()
        ]);

        $alphaKey->sendEmail();

        return redirect()
            ->back()
            ->with('status', "Alpha key assigned to [{$alphaSignUp->email}].");
    }
}
