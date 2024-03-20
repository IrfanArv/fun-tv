<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class AuthController extends BaseController
{
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('EDMHUB')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
        }
    }

    public function authUser(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user) {
            if ($request->ip() == $user->last_login_ip) {
                $token = $user->createToken('MyApp')->plainTextToken;
                return $this->sendResponse(['token' => $token, 'name' => $user->name], 'User login successful.');
            } else {
                return $this->sendError('Unauthorized.', ['error' => 'Unauthorized. IP address mismatch'], 406);
            }
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized. User not found'], 401);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->sendResponse('Success', 'User logout successfully.');
    }
}
