{{-- Top Navigation Bar --}}
<header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-surface-container-low h-16">
    <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center h-full">
        {{-- Left: Logo + Nav Links --}}
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-on-surface tracking-tight">SolveHub</a>
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('questions.index') }}" class="text-xs font-mono {{ (request()->routeIs('questions.index') && request('sort') !== 'popular') || request()->routeIs('home') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors duration-150 tracking-wider uppercase">Explore</a>
                <a href="{{ route('questions.index', ['sort' => 'popular']) }}" class="text-xs font-mono {{ request()->routeIs('questions.index') && request('sort') === 'popular' ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors duration-150 tracking-wider uppercase">Trending</a>
            </div>
        </div>

        {{-- Right: Auth Actions --}}
        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="text-xs font-mono text-on-surface-variant hover:text-primary transition-colors duration-150 px-4 py-2">Sign In</a>
                <a href="{{ route('register') }}" class="text-xs font-mono bg-primary-container text-on-primary-container px-5 py-2 rounded font-bold hover:opacity-90 active:scale-95 transition-all duration-150">Register</a>
            @else
                {{-- Search --}}
                <form action="{{ route('questions.index') }}" method="GET" class="hidden md:flex items-center">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant text-[16px]">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions..."
                               class="bg-surface-container-low border border-outline-variant rounded pl-9 pr-4 py-1.5 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all w-48 focus:w-64 placeholder:text-outline-variant/50"/>
                    </div>
                </form>

                <a href="{{ route('questions.create') }}" class="text-xs font-mono bg-primary-container text-on-primary-container px-5 py-2 rounded font-bold hover:opacity-90 active:scale-95 transition-all duration-150">
                    Ask Question
                </a>

                {{-- User Menu --}}
                <div class="relative" x-data="{ open: false }">
                    <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="flex items-center gap-2 text-on-surface-variant hover:text-on-surface transition-colors">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border border-outline-variant">
                        @else
                            <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xs">
                                {{ auth()->user()->initials }}
                            </div>
                        @endif
                        <span class="material-symbols-outlined text-sm">expand_more</span>
                    </button>
                    <div class="hidden absolute right-0 mt-2 w-48 bg-surface-container border border-outline-variant rounded-lg shadow-lg py-2 z-50">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-highest transition-colors">
                            <span class="material-symbols-outlined text-sm mr-2 align-middle">dashboard</span>Dashboard
                        </a>
                        <a href="{{ route('user.profile', auth()->id()) }}" class="block px-4 py-2 text-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-highest transition-colors">
                            <span class="material-symbols-outlined text-sm mr-2 align-middle">person</span>Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-highest transition-colors">
                            <span class="material-symbols-outlined text-sm mr-2 align-middle">settings</span>Settings
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-error hover:bg-surface-container-highest transition-colors">
                                <span class="material-symbols-outlined text-sm mr-2 align-middle">admin_panel_settings</span>Admin
                            </a>
                        @endif
                        <hr class="border-outline-variant/30 my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-on-surface-variant hover:text-error hover:bg-surface-container-highest transition-colors">
                                <span class="material-symbols-outlined text-sm mr-2 align-middle">logout</span>Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </nav>
</header>
