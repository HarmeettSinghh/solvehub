@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 mb-4 text-xs font-mono text-on-surface-variant">
        <a href="{{ route('questions.index') }}" class="hover:text-primary transition-colors">Questions</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('questions.index', ['category' => $question->category->slug]) }}" class="hover:text-primary transition-colors">{{ $question->category->name }}</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-on-surface">Detail</span>
    </nav>

    {{-- Question Title --}}
    <h1 class="text-2xl font-semibold text-on-surface mb-4 max-w-[800px] leading-snug">{{ $question->title }}</h1>

    {{-- Meta --}}
    <div class="flex items-center gap-4 text-sm text-on-surface-variant mb-8">
        <span>Asked <b class="text-on-surface font-medium">{{ $question->created_at->diffForHumans() }}</b></span>
        <span>Active <b class="text-on-surface font-medium">{{ $question->updated_at->diffForHumans() }}</b></span>
        <span>Viewed <b class="text-on-surface font-medium">{{ number_format($question->views_count) }} times</b></span>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">
        {{-- Left Column: Question + Answers --}}
        <div class="flex-grow max-w-[800px]">
            {{-- Question Body with Voting --}}
            <div class="flex gap-6 mb-12">
                {{-- Voting Column --}}
                <div class="flex flex-col items-center gap-2 w-10 flex-shrink-0">
                    @auth
                        <form action="{{ route('vote.store') }}" method="POST" class="vote-form">
                            @csrf
                            <input type="hidden" name="voteable_id" value="{{ $question->id }}">
                            <input type="hidden" name="voteable_type" value="question">
                            <input type="hidden" name="value" value="1">
                            <button type="submit" class="p-1 hover:bg-surface-container-highest transition-colors rounded text-on-surface-variant hover:text-primary">
                                <span class="material-symbols-outlined text-[32px]">arrow_drop_up</span>
                            </button>
                        </form>
                    @endauth

                    <span class="text-2xl font-semibold text-primary vote-score">{{ $question->vote_score }}</span>

                    @auth
                        <form action="{{ route('vote.store') }}" method="POST" class="vote-form">
                            @csrf
                            <input type="hidden" name="voteable_id" value="{{ $question->id }}">
                            <input type="hidden" name="voteable_type" value="question">
                            <input type="hidden" name="value" value="-1">
                            <button type="submit" class="p-1 hover:bg-surface-container-highest transition-colors rounded text-on-surface-variant hover:text-primary">
                                <span class="material-symbols-outlined text-[32px]">arrow_drop_down</span>
                            </button>
                        </form>
                    @endauth
                </div>

                {{-- Question Body --}}
                <div class="flex-grow">
                    <div class="text-base leading-relaxed text-on-surface-variant mb-4">
                        {!! nl2br(e($question->body)) !!}
                    </div>

                    {{-- Tags --}}
                    <div class="flex flex-wrap gap-2 mt-8">
                        @foreach($question->tags_array as $tag)
                            <a href="{{ route('questions.index', ['search' => $tag]) }}" class="text-xs font-mono px-3 py-1 bg-surface-container-high text-primary border border-outline-variant rounded hover:bg-surface-container-highest transition-colors">{{ $tag }}</a>
                        @endforeach
                    </div>

                    {{-- Actions Bar --}}
                    <div class="mt-12 flex justify-between items-start bg-surface-container-low p-4 rounded border border-outline-variant">
                        <div class="flex gap-4">
                            @auth
                                @if($question->user_id === auth()->id())
                                    <a href="{{ route('questions.edit', $question->slug) }}" class="text-on-surface-variant hover:text-primary text-sm font-medium transition-colors">Edit</a>
                                    <form action="{{ route('questions.destroy', $question->slug) }}" method="POST" onsubmit="return confirm('Delete this question?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-on-surface-variant hover:text-error text-sm font-medium transition-colors">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-on-surface-variant mb-2">asked {{ $question->created_at->format('M d \\a\\t H:i') }}</span>
                            <a href="{{ route('user.profile', $question->user_id) }}" class="flex items-center gap-2 hover:text-primary transition-colors">
                                <div class="w-8 h-8 rounded bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xs">{{ $question->user->initials }}</div>
                                <span class="text-primary text-sm font-semibold">{{ $question->user->name }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Answers Section --}}
            <div class="flex items-center justify-between border-b border-outline-variant pb-4 mb-6">
                <h2 class="text-2xl font-semibold text-on-surface">{{ $question->answers->count() }} {{ Str::plural('Answer', $question->answers->count()) }}</h2>
            </div>

            {{-- Answers List (accepted first) --}}
            @php
                $sortedAnswers = $question->answers->sortByDesc('is_accepted');
            @endphp
            @foreach($sortedAnswers as $answer)
                @include('components.answer-card', ['answer' => $answer, 'question' => $question])
            @endforeach

            {{-- Submit Answer Form --}}
            @auth
                <div class="mt-12 border-t border-outline-variant pt-8">
                    <h3 class="text-xl font-semibold text-on-surface mb-4">Your Answer</h3>
                    <form action="{{ route('answers.store', $question->id) }}" method="POST">
                        @csrf
                        <textarea name="body" rows="8" required
                                  class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-4 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none resize-none placeholder:text-outline-variant/50"
                                  placeholder="Write your answer here... Include code examples, links, and explanations.">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="mt-4 bg-primary text-on-primary px-8 py-3 rounded-lg text-xs font-bold hover:opacity-90 transition-opacity active:scale-95">
                            Post Your Answer
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-12 p-6 bg-surface-container border border-outline-variant rounded-lg text-center">
                    <p class="text-on-surface-variant mb-3">You need to be logged in to submit an answer.</p>
                    <a href="{{ route('login') }}" class="bg-primary text-on-primary px-6 py-2 rounded text-xs font-bold hover:opacity-90 transition-opacity">Sign In</a>
                </div>
            @endauth
        </div>

        {{-- Right Column: Sidebar --}}
        <aside class="w-full lg:w-[320px] flex-shrink-0">
            {{-- Question Stats --}}
            <div class="bg-surface-container border border-outline-variant rounded-lg p-6 mb-8">
                <h3 class="text-lg font-medium text-on-surface mb-6 border-b border-outline-variant pb-2">Question Stats</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-mono text-on-surface-variant">Score</span>
                        <span class="text-xs font-mono text-primary font-bold">{{ $question->vote_score }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-mono text-on-surface-variant">Answers</span>
                        <span class="text-xs font-mono text-on-surface">{{ $question->answers->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-mono text-on-surface-variant">Views</span>
                        <span class="text-xs font-mono text-on-surface">{{ number_format($question->views_count) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-mono text-on-surface-variant">Category</span>
                        <span class="tag-chip">{{ $question->category->name }}</span>
                    </div>
                </div>
            </div>

            {{-- Related Questions --}}
            @if($relatedQuestions->count() > 0)
            <div class="mb-8">
                <h3 class="text-lg font-medium text-on-surface mb-4">Related Questions</h3>
                <ul class="space-y-4">
                    @foreach($relatedQuestions as $related)
                        <li>
                            <a href="{{ route('questions.show', $related->slug) }}" class="text-sm text-primary hover:underline leading-snug block font-medium">{{ $related->title }}</a>
                            <span class="text-[10px] font-mono text-on-surface-variant mt-1 block">{{ $related->vote_score }} votes • {{ $related->answers_count }} answers</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </aside>
    </div>
</div>
@endsection
