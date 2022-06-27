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
            $data = Room::where('status', '=', 1)->firstOrFail();
            $streamKey = $data->stream_key;
            return view('pages.funtv.home.main', compact('data', 'streamKey','playerName'));
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


    public function watch(Request $request)
    {

        $roomId = $request->stream;

        $rooms = Room::where('stream_key', '=', $roomId)->firstOrFail();
        // dd($rooms);
        $nameRoom = $rooms->name;
        $streamKey = $rooms->stream_key;
        if ($rooms != null) {
            return view('pages.main.room', compact('rooms', 'nameRoom', 'streamKey'));
        } else {
            return redirect('')->with('error', 'Streaming room not found');
        }
    }

    public function getRoom()
    {
        $sanctumUser = auth('sanctum')->user();
        $RoomPlayers = $sanctumUser->room_id;
        $rooms = Room::find($RoomPlayers);
        if ($rooms == NULL) {
            return response([
                'success'   => false,
                'message' => ['Room identity not found']
            ], 201);
        }
        $response = [
            'success'        => true,
            'room_name'      => $rooms->name,
            'stream_key'     => $rooms->stream_key
        ];

        return response($response, 200);
    }
}
