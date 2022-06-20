<?php

namespace App\Http\Controllers\Backpage;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Question_details;
use App\Models\Room;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;

class QuestionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:trivia-quiz-list|trivia-quiz-create|trivia-quiz-edit|trivia-quiz-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:trivia-quiz-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:trivia-quiz-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:trivia-quiz-delete', ['only' => ['destroy']]);
    }

    public function question_by_rooms(Request $request)
    {
        $id_room = $request->id;
        $data = Question::where('room_id', $id_room)->latest()->paginate(10);
        $room = Room::findOrFail($id_room);
        $user = Auth::user();
        $user->load('rooms');
        return view('pages.backpage.quiz.by_room', compact('data','room','user'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    public function index()
    {
        $data = Question::latest()->paginate(5);
        return view('pages.backpage.quiz.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $questionId = $request->question_id;
        $this->validate($request, [
            'title' => 'required',
            'point' => 'required',
            'time' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
            if ($files = $request->file('image')) {
                \File::delete('img/question/' . $request->hidden_image);
                $destinationPath = 'img/question/';
                $questionImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $questionImage);
                $details['image'] = "$questionImage";
            }
        }else {
            $image = NULL;
        }
        $input = [
            'title' => $request->title,
            'point' => $request->point,
            'time' => $request->time,
            'room_id' => $request->room_id,
            'user_id' => Auth::user()->id,
            'status'  => 1,
            'image'   => $image
        ];
        $last_id =  Question::updateOrCreate(['id' => $questionId], $input);
        $question_id = $last_id->id;
        $jawaban = array(
            array('question_id'=>$question_id, 'answer_choice'=>$request->a_1, 'is_correct'=>$request->correct_1, 'sort_no'=>$request->sort_1),
            array('question_id'=>$question_id, 'answer_choice'=>$request->a_2, 'is_correct'=>$request->correct_2, 'sort_no'=>$request->sort_2),
            array('question_id'=>$question_id, 'answer_choice'=>$request->a_3, 'is_correct'=>$request->correct_3, 'sort_no'=>$request->sort_3),
            array('question_id'=>$question_id, 'answer_choice'=>$request->a_4, 'is_correct'=>$request->correct_4, 'sort_no'=>$request->sort_4),
        );
        Question_details::insert($jawaban);
        return response()->json(['data' => $input, 'last_id' => $last_id->id]);

    }

}
