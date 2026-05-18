@extends('layouts.app')

@section('content')
<div class="flex">
    {{-- Main Content Canvas --}}
    <div class="flex-1 min-w-0 p-6">
        {{-- Header --}}
        <header class="mb-12 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-semibold text-on-surface">System Overview</h2>
                <p class="text-base text-on-surface-variant mt-1">Real-time status of your technical queries and knowledge contributions.</p>
            </div>
            <a href="{{ route('questions.create') }}" class="bg-primary-container text-on-primary-container px-5 py-2.5 rounded text-xs font-mono font-bold hover:bg-primary transition-colors active:scale-95 duration-150">
                Ask Question
            </a>
        </header>

        {{-- Stats Row --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">
            @include('components.stat-card', ['label' => 'Total Solved', 'value' => $stats['total_solved'], 'highlight' => true, 'trend' => 'Solved questions', 'trendIcon' => 'check_circle'])
            @include('components.stat-card', ['label' => 'Questions Asked', 'value' => $stats['total_questions'], 'trend' => 'Your questions', 'trendIcon' => 'help_center'])
            @include('components.stat-card', ['label' => 'Answers Given', 'value' => $stats['total_answers'], 'trend' => 'Contributions', 'trendIcon' => 'forum'])
            @include('components.stat-card', ['label' => 'Reputation', 'value' => number_format($stats['reputation']) . ' XP', 'highlight' => true, 'trend' => 'Keep contributing!', 'trendIcon' => 'star'])
        </div>

        {{-- Questions Feed Table --}}
        <section class="bg-surface-container-low border border-outline-variant rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center">
                <h3 class="text-sm font-mono font-bold text-on-surface">Your Recent Questions</h3>
                <div class="flex gap-4">
                    <span class="text-xs font-mono text-on-surface-variant flex items-center">
                        <span class="w-2 h-2 rounded-full bg-secondary mr-2"></span> Solved
                    </span>
                    <span class="text-xs font-mono text-on-surface-variant flex items-center">
                        <span class="w-2 h-2 rounded-full bg-primary mr-2"></span> Pending
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container/50">
                            <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Status</th>
                            <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Title</th>
                            <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Category</th>
                            <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Answers</th>
                            <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Views</th>
                            <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-right">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/30">
                        @forelse($recentQuestions as $question)
                        <tr class="hover:bg-surface-container transition-colors cursor-pointer group" onclick="window.location='{{ route('questions.show', $question->slug) }}'">
                            <td class="px-6 py-4">
                                @if($question->is_solved)
                                    <span class="material-symbols-outlined text-secondary">check_circle</span>
                                @else
                                    <span class="material-symbols-outlined text-primary">hourglass_empty</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-on-surface group-hover:text-primary transition-colors">{{ Str::limit($question->title, 60) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="tag-chip">{{ $question->category->name ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-mono text-on-surface">{{ $question->answers_count }}</td>
                            <td class="px-6 py-4 text-center text-sm font-mono text-on-surface">{{ $question->views_count }}</td>
                            <td class="px-6 py-4 text-right">
                                <p class="text-xs text-on-surface-variant">{{ $question->created_at->diffForHumans() }}</p>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-3xl text-outline-variant mb-2 block">inbox</span>
                                <p>You haven't asked any questions yet.</p>
                                <a href="{{ route('questions.create') }}" class="text-primary hover:underline text-sm mt-2 inline-block">Ask your first question →</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($recentQuestions->count() > 0)
            <div class="px-6 py-4 border-t border-outline-variant bg-surface-container-low/30">
                <a href="{{ route('questions.index') }}" class="text-xs font-mono text-primary hover:underline">View all questions →</a>
            </div>
            @endif
        </section>
    </div>

    {{-- Right Panel --}}
    <aside class="w-[240px] border-l border-outline-variant p-6 bg-surface-dim min-h-screen hidden xl:block">
        {{-- Trending Tags --}}
        <section class="mb-12">
            <h3 class="text-[10px] font-mono text-on-surface-variant uppercase tracking-widest mb-6 opacity-60">Trending Tags</h3>
            <ul class="space-y-4">
                @php $i = 1; @endphp
                @foreach($trendingTags as $tag => $count)
                    <li class="flex items-start gap-4">
                        <span class="text-base font-mono text-outline-variant">{{ str_pad($i++, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <a href="{{ route('questions.index', ['search' => $tag]) }}" class="text-sm font-mono text-on-surface font-bold hover:text-primary cursor-pointer">#{{ $tag }}</a>
                            <p class="text-[10px] text-on-surface-variant opacity-70">{{ $count }} questions</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

        {{-- Recent Activity --}}
        <section>
            <h3 class="text-[10px] font-mono text-on-surface-variant uppercase tracking-widest mb-6 opacity-60">Network Activity</h3>
            <div class="space-y-6">
                @foreach($recentActivity as $activity)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary-container/20 flex items-center justify-center shrink-0 border border-primary-container/30">
                            <span class="material-symbols-outlined text-primary text-[14px]">forum</span>
                        </div>
                        <div>
                            <p class="text-sm text-on-surface leading-tight">
                                <span class="font-medium">{{ $activity->user->name }}</span> answered
                                <a href="{{ route('questions.show', $activity->question->slug) }}" class="text-primary hover:underline">{{ Str::limit($activity->question->title, 30) }}</a>
                            </p>
                            <p class="text-[10px] text-on-surface-variant mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </aside>
</div>
@endsection
