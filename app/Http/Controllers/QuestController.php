<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Question_details;

class QuestController extends Controller
{
    public function index()
    {
        $question               = Question::where('status', '=', 2)->first();
        if ($question == NULL) {
            $response = [
                'success'        => false,
                'message'        => 'no question run in this time'
            ];
            return response($response);
        } else {
            $questId            = $question->id;
            $answer             = Question_details::where('question_id', '=', $questId)->get();
            $response = [
                'success'        => true,
                'quest'          => $question,
                'answer'         => $answer
            ];

            return response($response);
        }
    }
}
