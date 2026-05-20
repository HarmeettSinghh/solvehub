{{-- Sidebar Navigation (Desktop Only) --}}
<aside class="fixed left-0 top-0 h-full w-[220px] bg-surface-dim border-r border-outline-variant py-4 z-40 hidden lg:flex flex-col">
    {{-- Brand --}}
    <div class="px-6 mb-10 mt-20">
        <a href="{{ route('home') }}">
            <h2 class="text-xl font-black text-primary">SolveHub</h2>
            <p class="text-xs font-mono text-on-surface-variant opacity-70 tracking-wider uppercase">Knowledge Engine</p>
        </a>
    </div>

    {{-- Main Navigation --}}
    <nav class="flex-1 space-y-1">
        <a href="{{ route('home') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('home') ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
            <span class="material-symbols-outlined mr-3">home</span>
            <span class="text-sm font-mono">Home</span>
        </a>
        <a href="{{ route('questions.index', ['sort' => 'popular']) }}" class="flex items-center px-6 py-3 {{ request()->routeIs('questions.index') && request('sort') === 'popular' ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
            <span class="material-symbols-outlined mr-3">trending_up</span>
            <span class="text-sm font-mono">Trending</span>
        </a>
        <a href="{{ route('questions.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('questions.index') && request('sort') !== 'popular' ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
            <span class="material-symbols-outlined mr-3">forum</span>
            <span class="text-sm font-mono">Questions</span>
        </a>

        @auth
            <div class="pt-6 pb-2 px-6">
                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest opacity-50 font-mono">Personal</p>
            </div>
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-surface-container-highest text-primary border-l-4 border-primary-container' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} transition-all duration-150">
                <span class="material-symbols-outlined mr-3">dashboard</span>
                <span class="text-sm font-mono">Dashboard</span>
            </a>
            <a href="{{ route('user.profile', auth()->id()) }}" class="flex items-center px-6 py-3 text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-all duration-150">
                <span class="material-symbols-outlined mr-3">person</span>
                <span class="text-sm font-mono">Profile</span>
            </a>
        @endauth
    </nav>

    {{-- Reputation Badge (Auth) --}}
    @auth
        <div class="px-6 mt-auto mb-4">
            <div class="p-3 bg-surface-container-low rounded-lg border border-outline-variant/30">
                <p class="text-[10px] text-on-surface-variant font-mono uppercase tracking-wider">Reputation</p>
                <p class="text-lg font-mono text-primary font-bold">{{ number_format(auth()->user()->reputation) }} XP</p>
            </div>
        </div>
    @endauth
</aside>
