@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-semibold text-on-surface mb-8">Manage Categories</h1>

    {{-- Create Category Form --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-lg p-6 mb-8">
        <h3 class="text-sm font-mono font-bold text-on-surface mb-4">Add New Category</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
            @csrf
            <input type="text" name="name" required placeholder="Category name"
                   class="flex-1 bg-surface-container-lowest border border-outline-variant rounded px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none"/>
            <input type="text" name="description" placeholder="Description (optional)"
                   class="flex-1 bg-surface-container-lowest border border-outline-variant rounded px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none"/>
            <input type="text" name="icon" placeholder="Icon name" value="folder"
                   class="w-32 bg-surface-container-lowest border border-outline-variant rounded px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none"/>
            <button type="submit" class="bg-primary text-on-primary px-6 py-2.5 rounded text-xs font-bold hover:opacity-90 transition-opacity whitespace-nowrap">Add Category</button>
        </form>
        @if($errors->any())
            <div class="mt-2">
                @foreach($errors->all() as $error)
                    <p class="text-error text-xs">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Categories List --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container/50">
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Name</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Slug</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Description</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Questions</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @foreach($categories as $cat)
                <tr class="hover:bg-surface-container transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-sm">{{ $cat->icon ?? 'folder' }}</span>
                            <span class="text-sm text-on-surface font-medium">{{ $cat->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-mono text-on-surface-variant">{{ $cat->slug }}</td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ Str::limit($cat->description, 40) ?? '—' }}</td>
                    <td class="px-6 py-4 text-center text-sm font-mono text-on-surface">{{ $cat->questions_count }}</td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST" onsubmit="return confirm('Delete category {{ $cat->name }}?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-error hover:underline text-xs font-mono">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
