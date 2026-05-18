@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-semibold text-on-surface mb-8">Admin Dashboard</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">
        @include('components.stat-card', ['label' => 'Total Users', 'value' => number_format($stats['total_users']), 'highlight' => true])
        @include('components.stat-card', ['label' => 'Total Questions', 'value' => number_format($stats['total_questions']), 'highlight' => true])
        @include('components.stat-card', ['label' => 'Total Answers', 'value' => number_format($stats['total_answers'])])
        @include('components.stat-card', ['label' => 'Solved Rate', 'value' => ($stats['total_questions'] > 0 ? round(($stats['solved_questions'] / $stats['total_questions']) * 100) : 0) . '%', 'highlight' => true])
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Questions --}}
        <div class="bg-surface-container-low border border-outline-variant rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant">
                <h3 class="text-sm font-mono font-bold text-on-surface">Recent Questions</h3>
            </div>
            <div class="divide-y divide-outline-variant/30">
                @foreach($recentQuestions as $q)
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-surface-container transition-colors">
                        <div>
                            <p class="text-sm text-on-surface">{{ Str::limit($q->title, 50) }}</p>
                            <p class="text-xs text-on-surface-variant mt-1">by {{ $q->user->name }} • {{ $q->created_at->diffForHumans() }}</p>
                        </div>
                        <form action="{{ route('admin.questions.delete', $q->id) }}" method="POST" onsubmit="return confirm('Delete this question?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-error hover:text-on-error-container text-xs font-mono">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Users --}}
        <div class="bg-surface-container-low border border-outline-variant rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant">
                <h3 class="text-sm font-mono font-bold text-on-surface">Recent Users</h3>
            </div>
            <div class="divide-y divide-outline-variant/30">
                @foreach($recentUsers as $u)
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-surface-container transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xs">
                                {{ $u->initials }}
                            </div>
                            <div>
                                <p class="text-sm text-on-surface">{{ $u->name }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $u->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($u->is_admin)
                                <span class="text-[10px] font-mono text-error uppercase bg-error-container/20 px-2 py-0.5 rounded">Admin</span>
                            @endif
                            <span class="text-xs font-mono text-primary">{{ $u->reputation }} XP</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
