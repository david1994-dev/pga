<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answers' => 'required',
        ]);
        
        $answers = array_map('trim', explode(',', $validated['answers']));
        Question::create([
            'title' => $validated['question'],
            'answers' => $answers,
            'created_by' => Auth::user()->id
        ]);

        return redirect()->route('dashboard')->with('status', 'question-stored');
    }

    public function index() {
        $questions = Question::query()->with('userQuestions', 'createdBy')->latest('id')->get();

        return view('dashboard', ['questions' => $questions]);
    }

    public function statisctical($id) {
        $question = Question::findOrFail($id);
        $questionUsers = $question->userQuestions()->orderBy('score', 'desc')->get();

        return view('question-statistical', ['question' => $question, 'questionUsers' => $questionUsers]);
    }
}
