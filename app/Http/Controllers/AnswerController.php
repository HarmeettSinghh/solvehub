<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a new answer for a question.
     */
    public function store(Request $request, $questionId)
    {
        $request->validate([
            'body' => 'required|string|min:10',
        ]);

        $question = Question::findOrFail($questionId);

        Answer::create([
            'question_id' => $question->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        // Award reputation to the answerer
        auth()->user()->increment('reputation', 5);

        return back()->with('success', 'Answer submitted successfully!');
    }

    /**
     * Update the specified answer.
     */
    public function update(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);

        // Only the owner can edit their answer
        if ($answer->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'body' => 'required|string|min:10',
        ]);

        $answer->update(['body' => $request->body]);

        return back()->with('success', 'Answer updated successfully!');
    }

    /**
     * Remove the specified answer.
     */
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);

        // Only the owner or admin can delete
        if ($answer->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $answer->delete();

        return back()->with('success', 'Answer deleted successfully!');
    }

    /**
     * Accept an answer (only the question owner can do this).
     */
    public function accept($id)
    {
        $answer = Answer::with('question')->findOrFail($id);

        // Only the question owner can accept an answer
        if ($answer->question->user_id !== auth()->id()) {
            abort(403);
        }

        // Unaccept any previously accepted answer
        Answer::where('question_id', $answer->question_id)
            ->where('is_accepted', true)
            ->update(['is_accepted' => false]);

        // Accept this answer
        $answer->update(['is_accepted' => true]);

        // Mark question as solved
        $answer->question->update(['is_solved' => true]);

        // Award reputation to the answer author
        $answer->user->increment('reputation', 15);

        return back()->with('success', 'Answer accepted!');
    }
}
