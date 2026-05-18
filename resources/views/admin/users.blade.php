@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-semibold text-on-surface mb-8">Manage Users</h1>

    <div class="bg-surface-container-low border border-outline-variant rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container/50">
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">User</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase">Email</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Questions</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Answers</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Reputation</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-center">Role</th>
                    <th class="px-6 py-3 text-[10px] font-mono text-on-surface-variant uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @foreach($users as $u)
                <tr class="hover:bg-surface-container transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xs">{{ $u->initials }}</div>
                            <span class="text-sm text-on-surface font-medium">{{ $u->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $u->email }}</td>
                    <td class="px-6 py-4 text-center text-sm font-mono text-on-surface">{{ $u->questions_count }}</td>
                    <td class="px-6 py-4 text-center text-sm font-mono text-on-surface">{{ $u->answers_count }}</td>
                    <td class="px-6 py-4 text-center text-sm font-mono text-primary">{{ $u->reputation }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($u->is_admin)
                            <span class="text-[10px] font-mono text-error uppercase bg-error-container/20 px-2 py-0.5 rounded">Admin</span>
                        @else
                            <span class="text-[10px] font-mono text-secondary uppercase">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($u->id !== auth()->id())
                            <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" onsubmit="return confirm('Delete user {{ $u->name }}? This will delete all their content.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-error hover:underline text-xs font-mono">Delete</button>
                            </form>
                        @else
                            <span class="text-xs text-on-surface-variant">You</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
