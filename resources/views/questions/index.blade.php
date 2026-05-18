@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-6xl mx-auto">
    {{-- Page Header --}}
    <header class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <h1 class="text-3xl font-semibold text-on-surface">Explore Questions</h1>
            <p class="text-base text-on-surface-variant mt-1">Browse and search through community knowledge.</p>
        </div>
        @auth
            <a href="{{ route('questions.create') }}" class="bg-primary-container text-on-primary-container px-6 py-2.5 rounded text-xs font-mono font-bold hover:bg-primary transition-colors active:scale-95 duration-150 self-start">
                Ask Question
            </a>
        @endauth
    </header>

    {{-- Search & Filter Bar --}}
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <form action="{{ route('questions.index') }}" method="GET" class="flex-1 flex gap-4">
            {{-- Search Input --}}
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions by title, body, or tags..."
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"/>
            </div>

            {{-- Category Filter --}}
            <div class="relative">
                <select name="category" onchange="this.form.submit()" class="appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 pr-10 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->questions_count }})</option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant text-sm">expand_more</span>
            </div>

            <button type="submit" class="bg-primary text-on-primary px-6 py-2.5 rounded-lg text-xs font-bold hover:opacity-90 transition-opacity">Search</button>

            {{-- Preserve sort --}}
            @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif
        </form>
    </div>

    {{-- Sort Tabs --}}
    <div class="flex gap-6 mb-6 border-b border-outline-variant pb-3">
        @php $currentSort = request('sort', 'latest'); @endphp
        <a href="{{ route('questions.index', array_merge(request()->except('sort', 'page'), ['sort' => 'latest'])) }}"
           class="text-xs font-mono uppercase tracking-wider {{ $currentSort === 'latest' ? 'text-primary border-b-2 border-primary pb-3 -mb-[13px]' : 'text-on-surface-variant hover:text-primary' }} transition-colors">Latest</a>
        <a href="{{ route('questions.index', array_merge(request()->except('sort', 'page'), ['sort' => 'popular'])) }}"
           class="text-xs font-mono uppercase tracking-wider {{ $currentSort === 'popular' ? 'text-primary border-b-2 border-primary pb-3 -mb-[13px]' : 'text-on-surface-variant hover:text-primary' }} transition-colors">Popular</a>
        <a href="{{ route('questions.index', array_merge(request()->except('sort', 'page'), ['sort' => 'unanswered'])) }}"
           class="text-xs font-mono uppercase tracking-wider {{ $currentSort === 'unanswered' ? 'text-primary border-b-2 border-primary pb-3 -mb-[13px]' : 'text-on-surface-variant hover:text-primary' }} transition-colors">Unanswered</a>
    </div>

    {{-- Questions List --}}
    <div class="space-y-4">
        @forelse($questions as $question)
            @include('components.question-card', ['question' => $question])
        @empty
            <div class="text-center py-16 text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline-variant mb-4 block">search_off</span>
                <p class="text-lg mb-2">No questions found.</p>
                <p class="text-sm">Try adjusting your search or filters.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($questions->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $questions->links() }}
        </div>
    @endif
</div>
@endsection
