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
        $questions = Question::query()->latest('id')->limit(1)->get();

        return view('welcome', ['questions' => $questions]);
    }

    public function anwser(Request $request) {
        $validatedData = $request->validate([
            'user_answer' => 'string|required',
        ]);

        $userAnswer = $request->except(['_token', 'user_answer']);
        foreach ($userAnswer as $qAnswer => $answer) {
            $questionId = (int)explode('_', $qAnswer)[1];
            $question = Question::findOrFail($questionId);
            if (count($answer) !== $question->max_answers) {
                throw new \Exception('You have selected more answers than allowed');
            }

            $userQuestion = new UserQuestion([
                'question_id' => $questionId,
                'answer' => $answer,
                'user_answer' => $validatedData['user_answer'],
            ]);

            $score = 0;
            foreach ($answer as $as) {
                if (in_array($as, $question->correct_answers)) {
                    $score++;
                }
            }

            $userQuestion->score = $score;
            $userQuestion->saveOrFail();
        }
        
        return redirect()->back()->with('status', 'answer-stored');
    }
}
