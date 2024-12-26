<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestion;

class UserQuestionController extends Controller
{
    public function anwser(Request $request) {
        $validatedData = $request->validate([
            'user_answer' => 'string|required',
            'answers' => 'array|required',
        ]);
        $questionUuid = $request->input('question_uuid');
        $question = Question::where('uuid', $questionUuid)->where('is_active', true)->firstOrFail();
        $answers = $validatedData['answers'];
        if (count($answers) !== $question->max_answers) {
            throw new \Exception('You have selected more answers than allowed');
        }
        
        $userQuestion = new UserQuestion([
            'question_id' => $question->id,
            'answer' => $answers,
            'user_answer' => $validatedData['user_answer'],
        ]);

        $score = 0;
        foreach ($answers as $as) {
            if (in_array($as, $question->correct_answers)) {
                $score++;
            }
        }

        $userQuestion->score = $score;
        $userQuestion->saveOrFail();

        return redirect()->route('home')->with('status', 'answer-stored');
    }
}
