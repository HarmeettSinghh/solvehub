<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with platform statistics.
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_questions' => Question::count(),
            'total_answers' => Answer::count(),
            'solved_questions' => Question::where('is_solved', true)->count(),
        ];

        $recentQuestions = Question::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentQuestions', 'recentUsers'));
    }

    /**
     * Display all users for management.
     */
    public function users()
    {
        $users = User::withCount(['questions', 'answers'])
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Delete a user and all their content.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account from admin panel.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Display categories management page.
     */
    public function categories()
    {
        $categories = Category::withCount('questions')->get();
        return view('admin.categories', compact('categories'));
    }

    /**
     * Store a new category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:50',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? 'folder',
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    /**
     * Update a category.
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:50',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? $category->icon,
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Delete a category.
     */
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->questions()->count() > 0) {
            return back()->with('error', 'Cannot delete a category that has questions. Move or delete the questions first.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }

    /**
     * Delete any question (admin privilege).
     */
    public function deleteQuestion($id)
    {
        Question::findOrFail($id)->delete();
        return back()->with('success', 'Question deleted successfully.');
    }

    /**
     * Delete any answer (admin privilege).
     */
    public function deleteAnswer($id)
    {
        Answer::findOrFail($id)->delete();
        return back()->with('success', 'Answer deleted successfully.');
    }
}
