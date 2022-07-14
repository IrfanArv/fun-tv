<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Events\listenPlayers;
use App\Models\LogPlayer;
use Illuminate\Support\Facades\DB;

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
            return view('pages.funtv.home.main', compact('data', 'streamKey', 'playerName', 'playerId'));
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
        $getPlayer          = Player::where('phone', '=', $phonePlayer)->firstOrFail();
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
                'image' => $request->avatar,
            ];
        }
        $log = [
            'player_id' => $getPlayer->id
        ];
        Player::updateOrCreate(['phone' => $phonePlayer], $input);
        LogPlayer::create($log);
        $count = LogPlayer::count();
        event(new listenPlayers($getPlayer, $count));
        return response()->json(['success' => true]);
    }

    public function getProfile(Request $request)
    {
        if ($request->session()->has('otp_auth')) {
            $getPlayerPhone     = $request->session()->get('phone_session');
            $getPlayer          = Player::where('phone', '=', $getPlayerPhone)->firstOrFail();
            return response()->json(array(
                'success' => true,
                'data' => $getPlayer
            ));
        }
    }

    public function updateProfile(Request $request)
    {
        $phonePlayer     = $request->session()->get('phone_session');
        $getPlayer          = Player::where('phone', '=', $phonePlayer)->firstOrFail();
        $id           = $getPlayer->id;
        $brith  = $request->brithday;
        $date_brith = date('Y-m-d', strtotime($brith));
        $input = [
            'image' => $request->avatar,
            'name'  => $request->fullname,
            'bio'   => $request->bio,
            'gender'   => $request->gender,
            'brith' => $date_brith
        ];

        $profile = Player::find($id);
        $profile->update($input);
        return response()->json(['success' => true]);
    }

    public function getPlayersActive()
    {
        $ava = DB::table('log_players')
            ->join('players', 'players.id', '=', 'log_players.player_id')
            ->select('players.image', 'players.username')
            ->orderBy('log_players.player_id', 'ASC')
            ->get();
        $count = LogPlayer::count();
        $response = [
            'success'      => true,
            'ava_list'     => $ava,
            'total_player'  => $count
        ];
        return response($response);
    }
}
