@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-[720px] mx-auto">
    {{-- Page Header --}}
    <header class="mb-8">
        <h1 class="text-2xl font-semibold text-on-surface mb-2">Ask a Question</h1>
        <p class="text-sm text-on-surface-variant">Provide the technical details and context to help the community solve your problem.</p>
    </header>

    {{-- Question Form --}}
    <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Title --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                   placeholder="e.g. How to implement zero-copy networking in Rust?"/>
            @error('title')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Category</label>
            <div class="relative">
                <select name="category_id" required
                        class="w-full appearance-none bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    <option value="">Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
            </div>
            @error('category_id')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Body / Description --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Problem Description</label>
            <div class="border border-outline-variant rounded-lg overflow-hidden flex flex-col bg-surface-container-lowest">
                {{-- Simple toolbar --}}
                <div class="flex items-center gap-2 p-2 border-b border-outline-variant bg-surface-container-low">
                    <button type="button" class="p-2 hover:bg-surface-container-highest rounded text-on-surface-variant transition-colors" title="Bold"><span class="material-symbols-outlined">format_bold</span></button>
                    <button type="button" class="p-2 hover:bg-surface-container-highest rounded text-on-surface-variant transition-colors" title="Italic"><span class="material-symbols-outlined">format_italic</span></button>
                    <button type="button" class="p-2 hover:bg-surface-container-highest rounded text-on-surface-variant transition-colors" title="Code"><span class="material-symbols-outlined">code</span></button>
                    <button type="button" class="p-2 hover:bg-surface-container-highest rounded text-on-surface-variant transition-colors" title="Link"><span class="material-symbols-outlined">link</span></button>
                    <div class="h-6 w-[1px] bg-outline-variant mx-1"></div>
                    <button type="button" class="p-2 hover:bg-surface-container-highest rounded text-on-surface-variant transition-colors" title="List"><span class="material-symbols-outlined">format_list_bulleted</span></button>
                </div>
                <textarea name="body" rows="12" required
                          class="w-full bg-transparent p-4 min-h-[300px] text-on-surface text-sm focus:outline-none resize-none placeholder:text-outline-variant/50"
                          placeholder="Describe what you've tried and what isn't working...">{{ old('body') }}</textarea>
            </div>
            @error('body')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tags --}}
        <div class="space-y-1">
            <label class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Tags (comma separated)</label>
            <input type="text" name="tags" value="{{ old('tags') }}"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                   placeholder="e.g. laravel, php, database, api"/>
            <p class="text-[10px] text-on-surface-variant mt-1">Add up to 5 tags separated by commas</p>
            @error('tags')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
            <button type="submit" class="w-full sm:w-auto bg-primary text-on-primary text-xs font-bold px-8 py-3 rounded-lg hover:bg-primary/90 transition-all duration-150 active:scale-95 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">send</span>
                Post Question
            </button>
            <a href="{{ route('questions.index') }}" class="w-full sm:w-auto text-center border border-outline-variant text-on-surface text-xs px-8 py-3 rounded-lg hover:bg-surface-container-highest transition-all duration-150">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
