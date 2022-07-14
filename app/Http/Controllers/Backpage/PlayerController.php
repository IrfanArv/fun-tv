<?php

namespace App\Http\Controllers\Backpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Room;
use Hash;
use Illuminate\Support\Arr;



class PlayerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:player-list|player-create|player-edit|player-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:player-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:player-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:player-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Player::orderBy('id', 'ASC')->paginate(10);
        return view('pages.backpage.player.main', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function player_by_rooms(Request $request)
    {
        $id_room = $request->id;
        $data = Player::where('room_id', $id_room)->latest()->paginate(10);
        $room = Room::findOrFail($id_room);
        return view('pages.backpage.player.by_room', compact('data','room'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        $userId = $request->player_id;
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:players,email,',
            'password' => 'required|same:confirm-password',
        ]);
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password'=> $request->password
        ];
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        Player::updateOrCreate(['id' => $userId], $input);
        return response()->json(['data' => $input]);

    }
}
