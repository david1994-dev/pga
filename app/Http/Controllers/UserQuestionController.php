<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestion;

class UserQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::query()->latest('id')->get();

        return view('welcome', ['questions' => $questions]);
    }

    public function anwser(Request $request) {
        $validatedData = $request->validate([
            'user_answer' => 'string|required',
        ]);

        $userAnswer = $request->except(['_token', 'user_answer']);
        foreach ($userAnswer as $qAnswer => $answer) {
            $questionId = (int)explode('_', $qAnswer)[1];
            $userQuestion = new UserQuestion([
                'question_id' => $questionId,
                'answer' => $answer,
                'user_answer' => $validatedData['user_answer'],
            ]);

            //update score
            $question = Question::findOrFail($questionId);
            $score = 0;
            foreach ($answer as $as) {
                if (in_array($as, $question->answers)) {
                    $score++;
                }
            }

            $userQuestion->score = $score;
            $userQuestion->saveOrFail();
        }
        
        return redirect()->back()->with('status', 'answer-stored');
    }
}
