<?php

namespace App\Http\Controllers\Backpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Auth;

class RoomController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rooms-list|rooms-create|rooms-edit|rooms-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:rooms-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rooms-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rooms-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Room::orderBy('id', 'ASC')->paginate(10);
        $user = Auth::user();
        $user->load('question');
        return view('pages.backpage.rooms.index', compact('data', 'user'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('pages.backpage.rooms.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'stream_key' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            $destinationPath = 'img/room/';
            $request->file('image')->move($destinationPath, $imageName);
            $input = [
                'name' => $request->name,
                'stream_key' => $request->stream_key,
                'status' => 1,
                'user_id' => Auth::user()->id,
                'desc' => $request->desc,
                'image' => date('YmdHis') . "." . $request->image->getClientOriginalExtension()
            ];
        } else {
            $input = [
                'name' => $request->name,
                'stream_key' => $request->stream_key,
                'status' => 1,
                'user_id' => Auth::user()->id,
                'desc' => $request->desc,
            ];
        }
        Room::create($input);
        return redirect()->route('rooms.index')
            ->with('success', 'New Room Stream created successfully');
    }

    public function edit($id)
    {
        $room = Room::find($id);
        return view('pages.backpage.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'stream_key' => 'required'
        ]);

        $input = [
            'name' => $request->name,
            'stream_key' => $request->stream_key,
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ];

        $rooms = Room::find($id);
        $rooms->update($input);

        return redirect()->route('rooms.index')
            ->with('success', 'Room Stream updated successfully');
    }

    public function destroy($id)
    {

        Room::find($id)->delete();
        return redirect()->route('rooms.index')
            ->with('success', 'Room Stream deleted successfully');
    }
}
