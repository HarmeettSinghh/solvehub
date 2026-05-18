{{-- Reusable Answer Card Component --}}
{{-- Usage: @include('components.answer-card', ['answer' => $answer, 'question' => $question]) --}}

@php $answer = $answer ?? null; @endphp
@if($answer)
<div class="mb-8 {{ $answer->is_accepted ? 'border-l-4 border-primary-container pl-6 py-2' : 'pt-8 border-t border-outline-variant' }}">
    <div class="flex gap-6">
        {{-- Voting Column --}}
        <div class="flex flex-col items-center gap-2 w-10 flex-shrink-0">
            <form action="{{ route('vote.store') }}" method="POST" class="vote-form">
                @csrf
                <input type="hidden" name="voteable_id" value="{{ $answer->id }}">
                <input type="hidden" name="voteable_type" value="answer">
                <input type="hidden" name="value" value="1">
                <button type="submit" class="p-1 hover:bg-surface-container-highest transition-colors rounded text-on-surface-variant hover:text-primary">
                    <span class="material-symbols-outlined text-[28px]">arrow_drop_up</span>
                </button>
            </form>

            <span class="text-xl font-semibold {{ $answer->is_accepted ? 'text-primary' : 'text-on-surface' }} vote-score">
                {{ $answer->vote_score }}
            </span>

            <form action="{{ route('vote.store') }}" method="POST" class="vote-form">
                @csrf
                <input type="hidden" name="voteable_id" value="{{ $answer->id }}">
                <input type="hidden" name="voteable_type" value="answer">
                <input type="hidden" name="value" value="-1">
                <button type="submit" class="p-1 hover:bg-surface-container-highest transition-colors rounded text-on-surface-variant hover:text-primary">
                    <span class="material-symbols-outlined text-[28px]">arrow_drop_down</span>
                </button>
            </form>

            {{-- Accepted checkmark --}}
            @if($answer->is_accepted)
                <span class="material-symbols-outlined text-primary-container mt-2" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            @endif
        </div>

        {{-- Answer Body --}}
        <div class="flex-grow">
            {{-- Accepted badge --}}
            @if($answer->is_accepted)
                <div class="inline-flex items-center gap-1 bg-primary-container/10 text-primary-container px-2 py-1 rounded text-xs font-bold mb-4 border border-primary-container/20">
                    <span class="material-symbols-outlined text-sm">verified</span>
                    ACCEPTED ANSWER
                </div>
            @endif

            {{-- Body text --}}
            <div class="text-base leading-relaxed text-on-surface-variant prose-invert">
                {!! nl2br(e($answer->body)) !!}
            </div>

            {{-- Actions --}}
            <div class="mt-8 flex justify-between items-start">
                <div class="flex gap-4">
                    {{-- Accept button (only visible to question owner) --}}
                    @auth
                        @if(isset($question) && $question->user_id === auth()->id() && !$answer->is_accepted)
                            <form action="{{ route('answers.accept', $answer->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-on-surface-variant hover:text-primary text-sm font-medium transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">check_circle</span> Accept
                                </button>
                            </form>
                        @endif

                        {{-- Edit/Delete (only answer owner) --}}
                        @if($answer->user_id === auth()->id())
                            <button onclick="document.getElementById('edit-answer-{{ $answer->id }}').classList.toggle('hidden')" class="text-on-surface-variant hover:text-primary text-sm font-medium transition-colors">Edit</button>
                            <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" onsubmit="return confirm('Delete this answer?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-on-surface-variant hover:text-error text-sm font-medium transition-colors">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>

                {{-- Author info --}}
                <div class="bg-surface-container-low p-3 rounded border border-outline-variant w-48">
                    <span class="text-xs text-on-surface-variant block mb-2">answered {{ $answer->created_at->diffForHumans() }}</span>
                    <a href="{{ route('user.profile', $answer->user_id) }}" class="flex items-center gap-2 hover:text-primary transition-colors">
                        <div class="w-8 h-8 rounded bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold text-xs">
                            {{ $answer->user->initials }}
                        </div>
                        <div>
                            <span class="text-primary text-sm font-semibold block">{{ $answer->user->name }}</span>
                            <span class="text-[10px] text-on-surface-variant font-mono uppercase tracking-wider">REP {{ number_format($answer->user->reputation) }}</span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Inline Edit Form (hidden by default) --}}
            @auth
                @if($answer->user_id === auth()->id())
                    <div id="edit-answer-{{ $answer->id }}" class="hidden mt-6">
                        <form action="{{ route('answers.update', $answer->id) }}" method="POST">
                            @csrf @method('PUT')
                            <textarea name="body" rows="4" class="w-full bg-surface-container-lowest border border-outline-variant rounded p-4 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">{{ $answer->body }}</textarea>
                            <div class="flex gap-2 mt-2">
                                <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded text-xs font-bold hover:opacity-90">Save</button>
                                <button type="button" onclick="this.closest('[id^=edit-answer]').classList.add('hidden')" class="border border-outline-variant text-on-surface px-4 py-2 rounded text-xs">Cancel</button>
                            </div>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endif
