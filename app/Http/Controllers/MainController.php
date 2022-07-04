<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Player;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(Request $request)
    {
        if ($request->session()->has('otp_auth')) {
            $getPlayerPhone     = $request->session()->get('phone_session');
            $getPlayer          = Player::where('phone', '=', $getPlayerPhone)->firstOrFail();
            $playerName         = $getPlayer->username;
            $playerId           = $getPlayer->id;
            $data = Room::where('status', '=', 1)->firstOrFail();
            $streamKey = $data->stream_key;
            return view('pages.funtv.home.main', compact('data', 'streamKey','playerName','playerId'));
        } else {
            return redirect()->route('players.login');
        }
    }

    public function user_check(Request $request)
    {
        $username = $request->username;
        $getuser = Player::where('username', '=', $username)->first();
        if ($getuser == null) {
            $response = [
                'success'        => true,
                'message'        => '<label class="text-success"><span>Yeay, username tersedia</span> <i class="fa-regular fa-circle-check"></i></label>'
            ];
            return response($response);
        } else {
            $response = [
                'success'        => false,
                'message'        => '<label class="text-danger"><span>Oups, username tidak tersedia</span> <i class="fa-regular fa-circle-xmark"></i></label>'
            ];
            return response($response);
        }
    }

    public function saveProfile(Request $request)
    {
        $phonePlayer = $request->phone;
        if ($request->hasFile('image')) {
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/players/';
            $request->file('image')->move($destinationPath, $imageName);
            $input = [
                'username' => $request->username,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension()
            ];
        } else {
            $input = [
                'username' => $request->username,
            ];
        }
        Player::updateOrCreate(['phone' => $phonePlayer], $input);
        return response()->json(['success' => true]);
    }

}
