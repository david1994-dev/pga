<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserQuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuestionController::class, 'home'])->name('home');

Route::post('/anwser', [UserQuestionController::class, 'anwser'])->name('anwser');

Route::get('/dashboard', [QuestionController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/question', function () {
    return view('question');
})->middleware(['auth'])->name('question');

Route::post('/question', [QuestionController::class, 'store'])->middleware(['auth'])->name('question.store');
Route::get('/question/{uuid}', [QuestionController::class, 'show'])->name('question.show');
Route::delete('/question/{id}', [QuestionController::class, 'delete'])->middleware(['auth'])->name('question.delete');
Route::put('/question/{id}', [QuestionController::class, 'update'])->middleware(['auth'])->name('question.update');
Route::get('/question-statistical/{id}', [QuestionController::class, 'statisctical'])->middleware(['auth'])->name('question.statistical');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
