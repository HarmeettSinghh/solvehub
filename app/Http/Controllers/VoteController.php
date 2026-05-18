<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Toggle a vote on a question or answer (AJAX endpoint).
     */
    public function store(Request $request)
    {
        $request->validate([
            'voteable_id' => 'required|integer',
            'voteable_type' => 'required|in:question,answer',
            'value' => 'required|in:1,-1',
        ]);

        $userId = auth()->id();
        $voteableType = $request->voteable_type === 'question'
            ? Question::class
            : Answer::class;

        // Check if user already voted on this item
        $existingVote = Vote::where('user_id', $userId)
            ->where('voteable_id', $request->voteable_id)
            ->where('voteable_type', $voteableType)
            ->first();

        if ($existingVote) {
            if ($existingVote->value == $request->value) {
                // Same vote again = remove the vote (toggle off)
                $existingVote->delete();
                $message = 'Vote removed.';
            } else {
                // Different vote = change direction
                $existingVote->update(['value' => $request->value]);
                $message = 'Vote updated.';
            }
        } else {
            // Create new vote
            Vote::create([
                'user_id' => $userId,
                'voteable_id' => $request->voteable_id,
                'voteable_type' => $voteableType,
                'value' => $request->value,
            ]);
            $message = 'Vote recorded.';
        }

        // Calculate new vote score
        $newScore = Vote::where('voteable_id', $request->voteable_id)
            ->where('voteable_type', $voteableType)
            ->sum('value');

        // Return JSON for AJAX requests
        if ($request->ajax() || $request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'score' => $newScore,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
