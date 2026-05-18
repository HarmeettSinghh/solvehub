{{-- Reusable Question Card Component --}}
{{-- Usage: @include('components.question-card', ['question' => $question]) --}}

@php $question = $question ?? null; @endphp
@if($question)
<div class="bg-surface-container-low border border-outline-variant p-5 hover:border-primary/50 transition-colors cursor-pointer group rounded-lg">
    <a href="{{ route('questions.show', $question->slug) }}" class="block">
        <div class="flex justify-between items-start mb-3">
            {{-- Tags --}}
            <div class="flex flex-wrap gap-2">
                @foreach($question->tags_array as $tag)
                    <span class="tag-chip">{{ strtolower($tag) }}</span>
                @endforeach
            </div>
            {{-- Status --}}
            <div class="flex items-center gap-2">
                @if($question->is_solved)
                    <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                @else
                    <span class="material-symbols-outlined text-primary text-sm">hourglass_empty</span>
                @endif
                <span class="text-[10px] font-mono text-on-surface-variant uppercase">{{ $question->created_at->diffForHumans(null, true) }} ago</span>
            </div>
        </div>

        {{-- Title --}}
        <h3 class="text-base font-semibold text-on-surface mb-2 group-hover:text-primary transition-colors leading-snug">
            {{ $question->title }}
        </h3>

        {{-- Excerpt --}}
        <p class="text-on-surface-variant text-sm line-clamp-2 mb-4">{{ Str::limit(strip_tags($question->body), 150) }}</p>

        {{-- Meta Row --}}
        <div class="flex items-center justify-between">
            <div class="flex gap-5 text-xs font-mono text-on-surface-variant">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">thumb_up</span>
                    {{ $question->vote_score }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">chat_bubble</span>
                    {{ $question->answers_count ?? $question->answers->count() }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">visibility</span>
                    {{ number_format($question->views_count) }}
                </span>
            </div>
            {{-- Author --}}
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center text-[9px] font-bold text-on-surface-variant border border-outline-variant/30">
                    {{ $question->user->initials }}
                </div>
                <span class="text-xs text-on-surface-variant">{{ $question->user->name }}</span>
            </div>
        </div>
    </a>
</div>
@endif
