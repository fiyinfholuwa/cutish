<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }



    public function store(Request $request)
{
    $request->validate([
        'token' => ['required'],
        'email' => ['required','email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $status = Password::reset(
        $request->only('email','password','password_confirmation','token'),
        function ($user) use ($request) {
            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new \Illuminate\Auth\Events\PasswordReset($user));
        }
    );

    return $request->wantsJson()
        ? ($status == Password::PASSWORD_RESET 
            ? response()->json(['status' => __($status)]) 
            : response()->json(['errors' => ['email' => [__($status)]]], 422))
        : ($status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]));
}
}
