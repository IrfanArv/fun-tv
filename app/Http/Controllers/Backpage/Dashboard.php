<?php

namespace App\Http\Controllers\Backpage;

use App\Events\PushQuiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Question;
use App\Models\Question_details;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $room = Room::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('pages.backpage.dashboard', compact('room'));
    }

    public function run_quiz($id)
    {
        $quest = Question::find($id);
        $detailQuestion = Question_details::where('question_id', $id)->get();
        $room_id = $quest->room_id;
        $get_time = $quest->time;
        $date_start     = date('Y-m-d H:i:s');
        $date_end       = date('Y-m-d H:i:s', strtotime("+$get_time min"));
        $data = [
            'date_start' => $date_start,
            'date_end' => $date_end,
            'status' => 2,
        ];
        $quest->update($data);
        event(new PushQuiz($room_id, $quest, $detailQuestion));
        return response()->json(array(
            'waktu_quiz' => $date_end,
            'status' => TRUE
        ));
    }

    public function stop_quiz($id)
    {
        $quest = Question::find($id);
        $data = [
            'status' => 3,
        ];
        $quest->update($data);
        return response()->json(array(
            'status' => TRUE
        ));
    }

    public function reset_quiz($id)
    {
        $quest = Question::find($id);
        $data = [
            'date_start' => NULL,
            'date_end' => NULL,
            'status' => 1,
        ];
        $quest->update($data);
        return response()->json(array(
            'status' => TRUE
        ));
    }

}

