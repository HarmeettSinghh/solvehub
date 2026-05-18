<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — {{ $title ?? 'SolveHub' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/geist@1.3.0/dist/fonts/geist.min.css" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-container-lowest text-on-surface selection:bg-primary/30 antialiased">

    {{-- Admin Top Bar --}}
    <header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-outline-variant h-16">
        <nav class="max-w-7xl mx-auto h-full flex justify-between items-center px-6">
            <div class="flex items-center gap-8">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-primary">SolveHub</a>
                <span class="text-xs font-mono text-error uppercase tracking-widest bg-error-container/20 px-3 py-1 rounded border border-error/20">Admin Panel</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-sm text-on-surface-variant hover:text-primary transition-colors font-mono">← Back to Site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-on-surface-variant hover:text-error transition-colors font-mono">Logout</button>
                </form>
            </div>
        </nav>
    </header>

    {{-- Admin Sidebar --}}
    <aside class="fixed left-0 top-0 h-full w-[220px] bg-surface-dim border-r border-outline-variant py-4 z-40 hidden lg:flex flex-col pt-20">
        <nav class="flex-1 space-y-1 mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
                <span class="material-symbols-outlined mr-3">dashboard</span>
                <span class="text-sm font-mono">Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users') ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
                <span class="material-symbols-outlined mr-3">group</span>
                <span class="text-sm font-mono">Users</span>
            </a>
            <a href="{{ route('admin.categories') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.categories') ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
                <span class="material-symbols-outlined mr-3">category</span>
                <span class="text-sm font-mono">Categories</span>
            </a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="lg:ml-[220px] pt-16 min-h-screen p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-primary-container/10 border border-primary-container/30 rounded-lg text-primary text-sm font-mono">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-error-container/10 border border-error/30 rounded-lg text-error text-sm font-mono">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
