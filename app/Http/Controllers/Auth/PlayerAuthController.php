<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PlayerAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    public function __construct()
    {
        $this->middleware('guest:players')->except('postLogout');
    }

    public function getLogin()
    {
        return view('auth.players.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if (auth()->guard('players')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->intended();
        } else {
            $this->incrementLoginAttempts($request);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Incorrect players login details!"]);
        }
    }

    public function postLogout()
    {
        auth()->guard('players')->logout();
        session()->flush();

        return redirect()->route('players.login');
    }
}
