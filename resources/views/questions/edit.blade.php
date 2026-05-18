@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-[720px] mx-auto">
    <header class="mb-8">
        <h1 class="text-2xl font-semibold text-on-surface mb-2">Edit Question</h1>
        <p class="text-sm text-on-surface-variant">Update the details of your question.</p>
    </header>

    <form action="{{ route('questions.update', $question->slug) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        {{-- Title --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title', $question->title) }}" required
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
            @error('title') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Category --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Category</label>
            <select name="category_id" required class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $question->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Body --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Problem Description</label>
            <textarea name="body" rows="12" required
                      class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-4 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none resize-none">{{ old('body', $question->body) }}</textarea>
            @error('body') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tags --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Tags (comma separated)</label>
            <input type="text" name="tags" value="{{ old('tags', $question->tags) }}"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none"/>
        </div>

        {{-- Submit --}}
        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-primary text-on-primary text-xs font-bold px-8 py-3 rounded-lg hover:opacity-90 transition-all active:scale-95">Update Question</button>
            <a href="{{ route('questions.show', $question->slug) }}" class="border border-outline-variant text-on-surface text-xs px-8 py-3 rounded-lg hover:bg-surface-container-highest transition-all">Cancel</a>
        </div>
    </form>
</div>
@endsection
