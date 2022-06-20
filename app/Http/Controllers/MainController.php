<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    // public function __construct()
    // {
    //    $this->middleware('auth:players');
    // }

    public function index()
    {
        $this->middleware('auth:players');

        $RoomPlayers = \Auth::guard('players')->user()->room_id;
        $rooms = Room::find($RoomPlayers);
        if ($rooms == NULL) {
            abort(404);
        }
        $title = $rooms->name;
        $streamId = $rooms->stream_key;

        $response = [
            'success'        => true,
            'room_name'      => $rooms->name,
            'stream_key'     => $rooms->stream_key
        ];

        return view('pages.main.room', compact('streamId', 'title'));
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
