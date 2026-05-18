<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of questions with search and filter.
     */
    public function index(Request $request)
    {
        $query = Question::with(['user', 'category'])->withCount('answers');

        // Search by title, body, or tags
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->byCategory($category->id);
            }
        }

        // Sort options
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'unanswered':
                $query->has('answers', '=', 0);
                $query->latest();
                break;
            default:
                $query->latest();
                break;
        }

        $questions = $query->paginate(15)->withQueryString();
        $categories = Category::withCount('questions')->get();

        return view('questions.index', compact('questions', 'categories'));
    }

    /**
     * Show the form for creating a new question.
     */
    public function create()
    {
        $categories = Category::all();
        return view('questions.create', compact('categories'));
    }

    /**
     * Store a newly created question.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:20',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string|max:255',
        ]);

        $question = Question::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'body' => $validated['body'],
            'tags' => $validated['tags'] ?? null,
        ]);

        return redirect()->route('questions.show', $question->slug)
            ->with('success', 'Question posted successfully!');
    }

    /**
     * Display the specified question with its answers.
     */
    public function show(string $slug)
    {
        $question = Question::with([
            'user',
            'category',
            'answers' => function ($q) {
                $q->with('user')->latest();
            },
            'comments.user',
            'votes',
        ])->where('slug', $slug)->firstOrFail();

        // Increment view count
        $question->increment('views_count');

        // Get related questions from same category
        $relatedQuestions = Question::where('category_id', $question->category_id)
            ->where('id', '!=', $question->id)
            ->withCount('answers')
            ->latest()
            ->take(4)
            ->get();

        return view('questions.show', compact('question', 'relatedQuestions'));
    }

    /**
     * Show the form for editing the specified question.
     */
    public function edit(string $slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();

        // Only the owner can edit
        if ($question->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $categories = Category::all();
        return view('questions.edit', compact('question', 'categories'));
    }

    /**
     * Update the specified question.
     */
    public function update(Request $request, string $slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();

        // Only the owner can update
        if ($question->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:20',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string|max:255',
        ]);

        $question->update($validated);

        return redirect()->route('questions.show', $question->slug)
            ->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified question.
     */
    public function destroy(string $slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();

        // Only the owner or admin can delete
        if ($question->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $question->delete();

        return redirect()->route('questions.index')
            ->with('success', 'Question deleted successfully!');
    }
}
