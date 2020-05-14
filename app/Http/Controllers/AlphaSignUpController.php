<?php

namespace App\Http\Controllers;

use App\AlphaSignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function view;

class AlphaSignUpController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', new AlphaSignUp);

        return view('alpha-sign-ups.index', [
            'alphaSignUps' => AlphaSignUp::with('alphaKeys')->paginate()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', new AlphaSignUp);

        $this->validate($request, [
            'email' => ['required', 'email', 'max:255', 'unique:App\\AlphaSignUp,email']
        ]);

        /** @var AlphaSignUp $alphaSignUp */
        $alphaSignUp = AlphaSignUp::query()->create([
           'email' => $request->input('email'),
            'user_id' => Auth::id(),
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip()
        ]);

        $alphaSignUp->sendEmail();
    }
}
