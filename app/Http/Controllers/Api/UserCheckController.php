<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;

class UserCheckController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Bad Request', $validator->errors(), 422);
        }

        // Get the username from the request
        $username = $request->input('username');

        $user = User::where('username', $username)->first();

        // Check if user exists
        if (!$user) {
            return $this->sendError('aktun tidak ditemukan', null, 404);
        }


        return $this->sendResponse($user, 'Akun ditemukan', 200);
    }
}
