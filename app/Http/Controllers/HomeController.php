<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Display the landing page with featured questions and stats.
     */
    public function index()
    {
        // Featured question (most voted recent question)
        $featured = Question::with(['user', 'category'])
            ->withCount('answers')
            ->latest()
            ->first();

        // Recent questions for the feed
        $questions = Question::with(['user', 'category'])
            ->withCount('answers')
            ->latest()
            ->take(10)
            ->get();

        // Trending tags (most used tags)
        $trendingTags = $this->getTrendingTags();

        // Platform stats
        $stats = [
            'total_questions' => Question::count(),
            'solved_today' => Question::where('is_solved', true)
                ->whereDate('updated_at', today())
                ->count(),
            'total_users' => \App\Models\User::count(),
            'total_answers' => \App\Models\Answer::count(),
        ];

        // Categories for sidebar
        $categories = Category::withCount('questions')->get();

        return view('home', compact('featured', 'questions', 'trendingTags', 'stats', 'categories'));
    }

    /**
     * Extract trending tags from questions.
     */
    private function getTrendingTags(): array
    {
        $allTags = Question::whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(fn($tags) => array_map('trim', explode(',', $tags)))
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(8)
            ->toArray();

        return $allTags;
    }
}
