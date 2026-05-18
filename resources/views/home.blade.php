@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-6xl mx-auto">

    {{-- Hero / Featured Question --}}
    @if($featured)
    <section class="mb-12">
        <div class="flex flex-col md:flex-row gap-8 bg-surface-container border border-outline-variant p-8 rounded-lg overflow-hidden relative">
            <div class="flex-1 z-10">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-primary text-on-primary text-[10px] font-bold px-2 py-0.5 rounded uppercase">Featured</span>
                    <span class="text-on-surface-variant text-[10px] font-mono uppercase tracking-widest">Post #{{ $featured->id }}</span>
                </div>
                <h1 class="text-3xl font-semibold mb-4 text-on-surface leading-tight">{{ $featured->title }}</h1>
                <p class="text-base text-on-surface-variant mb-6 max-w-2xl leading-relaxed">{{ Str::limit(strip_tags($featured->body), 200) }}</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('questions.show', $featured->slug) }}" class="bg-primary-container text-on-primary-container px-8 py-3 rounded text-xs font-bold uppercase tracking-wider hover:bg-primary transition-colors">
                        Join Discussion
                    </a>
                </div>
            </div>
            <div class="flex-none w-full md:w-1/3 h-48 md:h-auto rounded-lg overflow-hidden border border-outline-variant bg-surface-container-high flex items-center justify-center">
                <span class="material-symbols-outlined text-6xl text-outline-variant/50">forum</span>
            </div>
        </div>
    </section>
    @endif

    {{-- Content Grid --}}
    <section class="grid grid-cols-1 md:grid-cols-12 gap-6">

        {{-- Main Questions Feed --}}
        <div class="md:col-span-9 space-y-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-on-surface">Recent Questions</h2>
                <a href="{{ route('questions.index') }}" class="text-xs font-mono text-primary hover:underline">View all →</a>
            </div>

            @forelse($questions as $question)
                @include('components.question-card', ['question' => $question])
            @empty
                <div class="text-center py-16 text-on-surface-variant">
                    <span class="material-symbols-outlined text-4xl text-outline-variant mb-4 block">help_center</span>
                    <p class="text-lg mb-2">No questions yet!</p>
                    <p class="text-sm">Be the first to <a href="{{ route('questions.create') }}" class="text-primary hover:underline">ask a question</a>.</p>
                </div>
            @endforelse
        </div>

        {{-- Sidebar: Trending Tags --}}
        <div class="md:col-span-3 space-y-6">
            {{-- Trending Tags --}}
            <div class="bg-surface-container-lowest border border-outline-variant p-4 rounded-lg">
                <h4 class="text-xs font-mono text-on-surface mb-4 border-b border-outline-variant pb-2 flex items-center gap-2 uppercase tracking-wider">
                    <span class="material-symbols-outlined text-primary text-sm">trending_up</span>
                    Trending Tags
                </h4>
                <ul class="space-y-3">
                    @forelse($trendingTags as $tag => $count)
                        <li class="group flex items-center justify-between cursor-pointer">
                            <a href="{{ route('questions.index', ['search' => $tag]) }}" class="text-sm font-mono text-on-surface group-hover:text-primary transition-colors">#{{ $tag }}</a>
                            <span class="text-[10px] text-on-surface-variant font-mono">{{ $count }}</span>
                        </li>
                    @empty
                        <li class="text-xs text-on-surface-variant">No tags yet</li>
                    @endforelse
                </ul>
            </div>

            {{-- Categories --}}
            <div class="bg-surface-container-lowest border border-outline-variant p-4 rounded-lg">
                <h4 class="text-xs font-mono text-on-surface mb-4 border-b border-outline-variant pb-2 flex items-center gap-2 uppercase tracking-wider">
                    <span class="material-symbols-outlined text-primary text-sm">category</span>
                    Categories
                </h4>
                <ul class="space-y-2">
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('questions.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between text-sm text-on-surface-variant hover:text-primary transition-colors py-1">
                                <span>{{ $cat->name }}</span>
                                <span class="text-[10px] font-mono bg-surface-container-highest px-2 py-0.5 rounded">{{ $cat->questions_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Platform Stats --}}
    <section class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">
        @include('components.stat-card', ['label' => 'Total Questions', 'value' => number_format($stats['total_questions']), 'highlight' => true])
        @include('components.stat-card', ['label' => 'Solved Today', 'value' => number_format($stats['solved_today']), 'highlight' => true])
        @include('components.stat-card', ['label' => 'Total Answers', 'value' => number_format($stats['total_answers'])])
        @include('components.stat-card', ['label' => 'Community Members', 'value' => number_format($stats['total_users']), 'highlight' => true])
    </section>
</div>
@endsection
