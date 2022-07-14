<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Question_details;
use App\Models\Answers;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use App\Events\leadboard;


class QuestController extends Controller
{
    public function index(Request $request)
    {
        $question               = Question::where('status', '=', 2)->first();
        $getPlayerPhone     = $request->session()->get('phone_session');
        $getPlayer          = Player::where('phone', '=', $getPlayerPhone)->firstOrFail();
        $playerId           = $getPlayer->id;

        if ($question == NULL) {
            $response = [
                'success'        => false,
                'message'        => 'no question run in this time'
            ];
            return response($response);
        } else {
            $playingQuiz        = Answers::where('player_id', '=', $playerId)->where('question_id', '=', $question->id)->first();
            if ($playingQuiz) {
                $response = [
                    'success'        => false,
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

    public function postAnswer(Request $request)
    {
        $questData      = Question_details::find($request->answer);
        $isCorrect      = $questData->is_correct;
        $input = [
            'player_id'     => $request->player,
            'answer_id'     => $request->answer,
            'question_id'   => $request->quest,
            'corrected'     => $isCorrect
        ];
        Answers::create($input);
        $ranking = $this->leadboard();
        event(new leadboard($ranking));
        $response = [
            'status'        => true
        ];
        return response($response);
    }

    public function leadboard()
    {
        $lead = DB::table('answers')
            ->join('players', 'players.id', '=', 'answers.player_id')
            ->join('questions', 'questions.id', '=', 'answers.question_id')
            ->select('players.username', 'players.phone', 'players.image', DB::raw('SUM(questions.point) AS total_point'))
            ->where('answers.corrected', '=', 1)
            ->groupBy('players.id')
            ->orderBy('total_point', 'desc')
            ->take(10)
            ->get();
        $response = [
            'success'        => true,
            'leadboard'          => $lead,
        ];
        return response($response);
    }
}
