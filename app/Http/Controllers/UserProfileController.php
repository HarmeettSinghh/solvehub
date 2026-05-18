<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class UserProfileController extends Controller
{
    /**
     * Display a user's public profile.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // User stats
        $stats = [
            'reputation' => $user->reputation,
            'questions' => $user->questions()->count(),
            'answers' => $user->answers()->count(),
            'impact' => $user->questions()->sum('views_count'),
        ];

        // User's questions
        $questions = Question::with('category')
            ->where('user_id', $user->id)
            ->withCount('answers')
            ->latest()
            ->paginate(10);

        // User's recent answers
        $recentAnswers = Answer::with('question')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('profile.show', compact('user', 'stats', 'questions', 'recentAnswers'));
    }
}
