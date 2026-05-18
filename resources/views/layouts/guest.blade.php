<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SolveHub' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/geist@1.3.0/dist/fonts/geist.min.css" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-container-lowest text-on-surface selection:bg-primary/30 antialiased industrial-grid min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        {{-- Logo --}}
        <div class="text-center mb-10">
            <a href="{{ route('home') }}">
                <h1 class="text-3xl font-bold text-primary">SolveHub</h1>
                <p class="text-sm text-on-surface-variant mt-1 font-mono tracking-wider uppercase">Knowledge Engine</p>
            </a>
        </div>

        {{-- Auth Form Content --}}
        {{ $slot }}
    </div>
</body>
</html>
