<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class PlayerAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 10;
    protected $decayMinutes = 1;

    public function __construct()
    {
        $this->middleware('guest:players')->except('postLogout');
    }

    public function getLogin()
    {
        return view('pages.funtv.auth.login');
    }

    public function getOTP(Request $request)
    {
        if ($request->session()->has('phone_session')) {
            return view('pages.funtv.auth.otp');
        } else {
            return redirect()->route('players.login');
        }
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|min:10|numeric'
        ]);
        $phone = $request->phone;
        $input = [
            'phone' => $request->phone,
            'otp' => 443323
        ];
        Player::updateOrCreate(['phone' => $phone], $input);
        $request->session()->put('phone_session', $phone);
        return redirect()->route('players.otp');
    }

    public function postOTP(Request $request)
    {
        $this->validate($request, [
            'otp_key' => 'required|min:6|numeric'
        ]);
        $otpKey             = $request->otp_key;
        $getPlayerPhone     = $request->session()->get('phone_session');
        $getPlayer          = Player::where('phone', '=', $getPlayerPhone)->firstOrFail();
        $playerOTP          = $getPlayer->otp;
        $playerName         = $getPlayer->username;

        $auth_otp = [
            'phone' => $getPlayerPhone,
            'otp' => $playerOTP
        ];

        if ($otpKey != $playerOTP) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Kode OTP Tidak Sesuai"]);
        } else {
            $request->session()->put('otp_auth', $auth_otp);
            if ($playerName == NULL) {
                return view('pages.funtv.profile.create',compact('getPlayerPhone'));
            } else {
                return redirect()->route('home');
            }
        }

        // if (auth()->guard('players')->attempt($request->only('email', 'password'))) {
        // $request->session()->regenerate();
        // $this->clearLoginAttempts($request);
        // return redirect()->intended();
        // } else {
        //     $this->incrementLoginAttempts($request);

        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->withErrors(["Incorrect players login details!"]);
        // }
    }

    public function getRegister()
    {
        return view('auth.players.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:players,email',
            'password' => 'required|same:password_confirmation',
        ]);
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'trivia_status' => 0,
            'trivia_score' => 0
        ];
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        Player::Create($input);
    }

    public function postLogout()
    {
        auth()->guard('players')->logout();
        session()->flush();

        return redirect()->route('home');
    }
}
