<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ConfirmPasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function showConfirmForm()
    {
        return view('auth.passwords.confirm');
    }

    /**
     * Confirm the given user's password.
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['The password is incorrect.'],
            ]);
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }
}
