<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\UserQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required',
        ]);
        
        $inputDatas = $request->except(['_token', 'question']);
        $answers = [];
        $correctAnswers = [];
        foreach ($inputDatas as $key => $v) {
            if (strpos($key, 'answer') !== false) {
                $answers[] = trim($v);
            }

            $answerIndex = explode('_', $key)[1];
            if (isset($inputDatas['is_correct_' . $answerIndex])) {
                $correctAnswers[] = trim($v);
            }
        }

        Question::create([
            'title' => $validated['question'],
            'answers' => $answers,
            'correct_answers' => $correctAnswers,
            'max_answers' => count($correctAnswers),
            'created_by' => Auth::user()->id,
            'uuid' => Str::uuid()->toString(),
        ]);

        return redirect()->route('dashboard')->with('status', 'question-stored');
    }

    public function index() {
        $questions = Question::query()->with('userQuestions', 'createdBy')->latest('id')->get();

        return view('dashboard', ['questions' => $questions]);
    }

    public function home() {
        return view('home');
    }

    public function show($uuid) {
        $question = Question::query()->where('uuid', $uuid)->firstOrFail();

        return view('welcome', ['question' => $question]);
    }

    public function statisctical($id) {
        $question = Question::findOrFail($id);
        $questionUsers = $question->userQuestions()->orderBy('score', 'desc')->paginate(20);

        return view('question-statistical', ['question' => $question, 'questionUsers' => $questionUsers]);
    }

    public function delete($id) {
        Question::findOrFail($id)->delete();
        UserQuestion::where('question_id', $id)->delete();

        return response()->json(['status' => 'success']);
    }
}
