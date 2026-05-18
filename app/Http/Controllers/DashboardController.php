<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // User's stats
        $stats = [
            'total_solved' => $user->questions()->where('is_solved', true)->count(),
            'total_questions' => $user->questions()->count(),
            'total_answers' => $user->answers()->count(),
            'reputation' => $user->reputation,
        ];

        // User's recent questions
        $recentQuestions = Question::with(['category'])
            ->where('user_id', $user->id)
            ->withCount('answers')
            ->latest()
            ->take(10)
            ->get();

        // Trending tags
        $trendingTags = Question::whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(fn($tags) => array_map('trim', explode(',', $tags)))
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(5)
            ->toArray();

        // Recent platform activity
        $recentActivity = Answer::with(['user', 'question'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentQuestions', 'trendingTags', 'recentActivity'));
    }
}
