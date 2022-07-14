<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Player;
use App\Events\liveChat;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(Request $request)
    {

        $getPlayerPhone     = $request->session()->get('phone_session');
        $players            = Player::where('phone', '=', $getPlayerPhone)->firstOrFail();
        $playerId           = $players->id;
        $conversations = DB::table('chats')
        ->join('players', 'players.id', '=', 'chats.player_id')
        ->select('players.image','chats.conversation','chats.created_at','chats.player_id')
        ->orderBy('chats.created_at', 'ASC')
        ->get();

        $response = [
            'status'    => true,
            'chat'      => $conversations,
            'mychat'    => $playerId
        ];
        return response($response);
    }

    public function store(Request $request)
    {
        $getPlayerPhone     = $request->session()->get('phone_session');
        $players            = Player::where('phone', '=', $getPlayerPhone)->firstOrFail();
        $playerId           = $players->id;
        $playerImage        = $players->image;
        $conversations      = $request->conversations;
        $sendTime           = date('Y-m-d H:i:s');
        $input = [
            'player_id'     => $playerId,
            'conversation'  => $conversations,
        ];
        Chat::create($input);
        $response = [
            'status'        => true
        ];
        event(new liveChat($playerId, $playerImage, $conversations, $sendTime));
        return response($response);

    }
}
