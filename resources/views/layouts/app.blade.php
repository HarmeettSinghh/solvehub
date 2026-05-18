<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SolveHub — Knowledge Sharing Platform' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'SolveHub is a modern knowledge sharing and problem solving platform for students, developers, and learners.' }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/geist@1.3.0/dist/fonts/geist.min.css" rel="stylesheet"/>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-container-lowest text-on-surface selection:bg-primary/30 antialiased">

    {{-- Top Navigation Bar --}}
    @include('partials.navbar')

    {{-- Sidebar (Desktop) --}}
    @include('partials.sidebar')

    {{-- Main Content --}}
    <main class="lg:ml-[220px] pt-16 min-h-screen">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-primary-container/10 border border-primary-container/30 rounded-lg text-primary text-sm font-mono" id="flash-success">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 p-4 bg-error-container/10 border border-error/30 rounded-lg text-error text-sm font-mono" id="flash-error">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">error</span>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Auto-dismiss flash messages --}}
    <script>
        setTimeout(() => {
            document.querySelectorAll('[id^="flash-"]').forEach(el => {
                el.style.transition = 'opacity 0.3s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 300);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
