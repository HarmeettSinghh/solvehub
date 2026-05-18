@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-6xl mx-auto">
    {{-- Profile Header --}}
    <section class="flex flex-col md:flex-row md:items-end gap-8 mb-12">
        <div class="relative">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-xl object-cover border border-outline-variant">
            @else
                <div class="w-16 h-16 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xl border border-outline-variant">
                    {{ $user->initials }}
                </div>
            @endif
            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-primary rounded-full border-2 border-background"></div>
        </div>
        <div class="flex-1 flex flex-col gap-2">
            <h1 class="text-2xl font-semibold text-on-surface leading-none">{{ $user->name }}</h1>
            <div class="flex flex-wrap gap-x-6 gap-y-2 text-xs text-on-surface-variant">
                @if($user->bio)
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-primary">description</span>
                        <span>{{ $user->bio }}</span>
                    </div>
                @endif
                @if($user->location)
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                        <span>{{ $user->location }}</span>
                    </div>
                @endif
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                    <span>Joined {{ $user->created_at->format('F Y') }}</span>
                </div>
            </div>
        </div>
        @auth
            @if(auth()->id() === $user->id)
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-surface-container border border-outline-variant text-xs text-on-surface hover:bg-surface-container-highest transition-colors flex items-center gap-2 rounded">
                    <span class="material-symbols-outlined text-[16px]">edit</span> Edit Profile
                </a>
            @endif
        @endauth
    </section>

    {{-- Stats Row --}}
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
        <div class="bg-surface-container-low border border-outline-variant p-4 rounded-lg">
            <p class="text-[10px] font-mono text-on-surface-variant uppercase mb-1">Reputation</p>
            <p class="text-2xl font-bold text-primary">{{ number_format($stats['reputation']) }}</p>
        </div>
        <div class="bg-surface-container-low border border-outline-variant p-4 rounded-lg">
            <p class="text-[10px] font-mono text-on-surface-variant uppercase mb-1">Questions</p>
            <p class="text-2xl font-bold text-on-surface">{{ $stats['questions'] }}</p>
        </div>
        <div class="bg-surface-container-low border border-outline-variant p-4 rounded-lg">
            <p class="text-[10px] font-mono text-on-surface-variant uppercase mb-1">Answers</p>
            <p class="text-2xl font-bold text-on-surface">{{ $stats['answers'] }}</p>
        </div>
        <div class="bg-surface-container-low border border-outline-variant p-4 rounded-lg">
            <p class="text-[10px] font-mono text-on-surface-variant uppercase mb-1">Impact</p>
            <p class="text-2xl font-bold text-on-surface">{{ number_format($stats['impact']) }}</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Questions List --}}
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-lg font-semibold text-on-surface mb-4">Questions by {{ $user->name }}</h2>
            @forelse($questions as $question)
                @include('components.question-card', ['question' => $question])
            @empty
                <div class="text-center py-12 text-on-surface-variant">
                    <p>No questions yet.</p>
                </div>
            @endforelse

            {{ $questions->links() }}
        </div>

        {{-- Activity Timeline --}}
        <div class="space-y-8">
            <div class="bg-surface-container border border-outline-variant p-6 rounded-lg">
                <h4 class="text-xs text-primary uppercase mb-6 flex items-center gap-2 font-bold">
                    <span class="material-symbols-outlined text-[18px]">history</span>
                    Recent Activity
                </h4>
                <div class="relative flex flex-col gap-8">
                    <div class="absolute left-[7px] top-2 bottom-2 w-px bg-outline-variant/30"></div>
                    @foreach($recentAnswers as $answer)
                        <div class="relative pl-8">
                            <div class="absolute left-0 top-1.5 w-3.5 h-3.5 bg-primary rounded-full border-2 border-background z-10"></div>
                            <p class="text-[10px] font-mono text-on-surface-variant mb-1 uppercase">{{ $answer->created_at->format('Y-m-d H:i') }}</p>
                            <p class="text-sm text-on-surface">
                                Answered <a href="{{ route('questions.show', $answer->question->slug) }}" class="text-primary font-medium hover:underline">"{{ Str::limit($answer->question->title, 40) }}"</a>
                            </p>
                        </div>
                    @endforeach

                    @if($recentAnswers->isEmpty())
                        <p class="text-sm text-on-surface-variant pl-8">No recent activity.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
