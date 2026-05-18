<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Vote;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Seed sample questions with answers and votes.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        $questions = [
            [
                'title' => 'How to implement authentication middleware in Laravel 12?',
                'body' => "I'm building a web application using Laravel 12 and I need to protect certain routes with authentication middleware. I've set up the basic routes, but I'm struggling with how to properly apply middleware to groups of routes.\n\nHere's my current routes/web.php setup:\n\nRoute::get('/dashboard', function () {\n    return view('dashboard');\n});\n\nHow do I ensure only authenticated users can access the dashboard and other protected routes? Also, how do I redirect unauthenticated users to the login page?",
                'tags' => 'laravel,middleware,authentication,php',
                'category' => 'Web Development',
                'is_solved' => true,
            ],
            [
                'title' => 'Best practices for normalizing a database schema in 3NF',
                'body' => "I'm designing a database for a student management system and I want to ensure it follows Third Normal Form (3NF). Currently, my 'students' table has the following columns:\n\n- student_id\n- name\n- email\n- department_name\n- department_head\n- course_name\n- course_credits\n- professor_name\n\nI know this has redundancy issues. Can someone guide me through the normalization process step by step?",
                'tags' => 'database,normalization,sql,schema-design',
                'category' => 'DBMS',
                'is_solved' => true,
            ],
            [
                'title' => 'Understanding recursion with backtracking for N-Queens problem',
                'body' => "I'm trying to solve the N-Queens problem using backtracking but I'm having trouble understanding how the recursive function knows when to backtrack. Here's my current attempt in Python:\n\ndef solve_queens(board, col, n):\n    if col >= n:\n        return True\n    for i in range(n):\n        if is_safe(board, i, col, n):\n            board[i][col] = 1\n            if solve_queens(board, col + 1, n):\n                return True\n            board[i][col] = 0  # backtrack\n    return False\n\nCan someone explain the flow of execution when n=4? When exactly does the backtracking happen?",
                'tags' => 'algorithms,recursion,backtracking,python',
                'category' => 'Programming',
                'is_solved' => false,
            ],
            [
                'title' => 'How to build a simple neural network from scratch using NumPy?',
                'body' => "I want to understand the fundamentals of neural networks by building one from scratch without using any ML frameworks like TensorFlow or PyTorch. I want to implement:\n\n1. Forward propagation\n2. Backpropagation\n3. Gradient descent\n\nCould someone provide a clear implementation for a simple 2-layer neural network that can learn the XOR function? I'd especially appreciate explanations for the math behind each step.",
                'tags' => 'neural-networks,numpy,python,deep-learning',
                'category' => 'AI/ML',
                'is_solved' => false,
            ],
            [
                'title' => 'Proving the time complexity of merge sort using the Master Theorem',
                'body' => "I understand that merge sort has O(n log n) time complexity, but I'm struggling to prove it formally using the Master Theorem. The recurrence relation is:\n\nT(n) = 2T(n/2) + O(n)\n\nCan someone walk me through how to apply the Master Theorem to this recurrence and arrive at the O(n log n) result? I'm also confused about when to use the Master Theorem vs. the substitution method.",
                'tags' => 'complexity,algorithms,mathematics,proofs',
                'category' => 'Mathematics',
                'is_solved' => true,
            ],
            [
                'title' => 'Tips for preparing for a software engineering internship interview',
                'body' => "I'm a third-year CS student preparing for software engineering internship interviews at tech companies. I've been solving LeetCode problems but I feel like I'm not making progress.\n\nSpecifically, I'd like to know:\n1. How many LeetCode problems should I solve before applying?\n2. Which topics are most frequently tested?\n3. How should I prepare for behavioral questions?\n4. Any tips for system design rounds at the intern level?\n\nI'd appreciate advice from anyone who has gone through this process recently.",
                'tags' => 'career,interview,internship,software-engineering',
                'category' => 'Career Guidance',
                'is_solved' => false,
            ],
            [
                'title' => 'Setting up a REST API with Laravel Resource Controllers',
                'body' => "I'm building a REST API for a mobile app using Laravel. I've heard about Resource Controllers but I'm not sure how to set them up properly. I need endpoints for:\n\n- GET /api/products (list all)\n- GET /api/products/{id} (show one)\n- POST /api/products (create)\n- PUT /api/products/{id} (update)\n- DELETE /api/products/{id} (delete)\n\nWhat's the correct way to define these using artisan commands and route definitions? How do I handle JSON responses and validation?",
                'tags' => 'laravel,rest-api,php,backend',
                'category' => 'Web Development',
                'is_solved' => true,
            ],
            [
                'title' => 'Difference between Eloquent relationships: hasOne vs belongsTo',
                'body' => "I'm confused about when to use hasOne vs belongsTo in Laravel's Eloquent ORM. For example, if I have a User model and a Profile model where each user has exactly one profile:\n\n- Should User hasOne Profile?\n- Should Profile belongsTo User?\n- Or should both be set up?\n\nI understand that the foreign key placement matters, but I'd appreciate a clear explanation with code examples showing when to use each type of relationship.",
                'tags' => 'laravel,eloquent,orm,relationships',
                'category' => 'Web Development',
                'is_solved' => true,
            ],
            [
                'title' => 'How to optimize SQL queries on large tables with millions of rows?',
                'body' => "Our production database has a 'transactions' table with over 50 million rows and queries are becoming very slow. We're currently running queries like:\n\nSELECT * FROM transactions WHERE user_id = 12345 AND created_at > '2024-01-01' ORDER BY created_at DESC LIMIT 50;\n\nThis query takes 8-10 seconds even with an index on user_id. What are the best practices for optimizing queries on tables of this size? Should we consider partitioning, composite indexes, or something else?",
                'tags' => 'sql,performance,indexing,optimization',
                'category' => 'DBMS',
                'is_solved' => false,
            ],
            [
                'title' => 'Understanding Big-O notation for nested loops',
                'body' => "I'm trying to understand the time complexity of algorithms with nested loops. I know that two nested for-loops from 0 to n gives O(n²), but what about these cases:\n\n1. Outer loop: 0 to n, Inner loop: 0 to n/2\n2. Outer loop: 0 to n, Inner loop: starts from i to n\n3. Outer loop: 0 to n, Inner loop: 0 to log(n)\n\nCan someone help me analyze the time complexity for each of these patterns and explain the reasoning?",
                'tags' => 'big-o,complexity,algorithms,loops',
                'category' => 'Programming',
                'is_solved' => false,
            ],
        ];

        $answers = [
            "Great question! In Laravel 12, you can use the middleware method on route groups:\n\nRoute::middleware(['auth'])->group(function () {\n    Route::get('/dashboard', [DashboardController::class, 'index']);\n});\n\nThis will automatically redirect unauthenticated users to the login page. You can also use the 'verified' middleware if you want email verification.",
            "To normalize to 3NF, start by identifying functional dependencies:\n\n1. student_id → name, email\n2. department_name → department_head\n3. course_name → course_credits\n\nCreate separate tables: students, departments, courses, and enrollment (junction table). This eliminates transitive dependencies and puts the schema in 3NF.",
            "The backtracking happens at line 'board[i][col] = 0'. When solve_queens returns False for the next column, it means no valid position was found. So we undo our choice (set to 0) and try the next row. For n=4, it tries row 0 of col 0, then row 2 of col 1, then finds no safe spot in col 2, backtracks to col 1 row 3, and so on.",
            "Here's a simple implementation:\n\nimport numpy as np\n\nclass NeuralNetwork:\n    def __init__(self):\n        self.weights1 = np.random.randn(2, 4)\n        self.weights2 = np.random.randn(4, 1)\n    \n    def sigmoid(self, x):\n        return 1 / (1 + np.exp(-x))\n    \n    def forward(self, X):\n        self.z1 = np.dot(X, self.weights1)\n        self.a1 = self.sigmoid(self.z1)\n        self.z2 = np.dot(self.a1, self.weights2)\n        return self.sigmoid(self.z2)\n\nThe key is understanding that each layer applies a linear transformation followed by an activation function.",
            "Using the Master Theorem: T(n) = aT(n/b) + f(n)\nHere a=2, b=2, f(n)=cn\n\nCompute n^(log_b(a)) = n^(log_2(2)) = n^1 = n\nSince f(n) = Θ(n) = Θ(n^(log_b(a))), this is Case 2.\nTherefore T(n) = Θ(n log n). QED.",
        ];

        foreach ($questions as $idx => $q) {
            $cat = $categories->where('name', $q['category'])->first();
            $author = $users->random();

            $question = Question::create([
                'user_id' => $author->id,
                'category_id' => $cat->id,
                'title' => $q['title'],
                'slug' => Str::slug($q['title']) . '-' . Str::random(5),
                'body' => $q['body'],
                'tags' => $q['tags'],
                'views_count' => rand(50, 5000),
                'is_solved' => $q['is_solved'],
            ]);

            // Add answer if available
            if (isset($answers[$idx])) {
                $answerer = $users->where('id', '!=', $author->id)->random();
                $answer = Answer::create([
                    'question_id' => $question->id,
                    'user_id' => $answerer->id,
                    'body' => $answers[$idx],
                    'is_accepted' => $q['is_solved'],
                ]);

                // Add votes to the answer
                $voterCount = rand(2, 5);
                $voters = $users->where('id', '!=', $answerer->id)->random(min($voterCount, $users->count() - 1));
                foreach ($voters as $voter) {
                    Vote::create([
                        'user_id' => $voter->id,
                        'voteable_id' => $answer->id,
                        'voteable_type' => Answer::class,
                        'value' => 1,
                    ]);
                }
            }

            // Add votes to the question
            $voterCount = rand(1, 4);
            $voters = $users->where('id', '!=', $author->id)->random(min($voterCount, $users->count() - 1));
            foreach ($voters as $voter) {
                Vote::create([
                    'user_id' => $voter->id,
                    'voteable_id' => $question->id,
                    'voteable_type' => Question::class,
                    'value' => rand(0, 1) ? 1 : -1,
                ]);
            }
        }
    }
}
