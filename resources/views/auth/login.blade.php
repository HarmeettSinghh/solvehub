<x-guest-layout>
    <div class="bg-surface-container border border-outline-variant rounded-lg p-8">
        <h2 class="text-xl font-semibold text-on-surface mb-6 text-center">Sign In</h2>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-primary bg-primary-container/10 border border-primary-container/30 rounded p-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                       placeholder="your@email.com"/>
                @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       placeholder="••••••••"/>
                @error('password') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-outline-variant text-primary focus:ring-primary bg-surface-container-lowest">
                    <span class="text-xs text-on-surface-variant">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-primary hover:underline">Forgot password?</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-lg text-sm font-bold hover:opacity-90 transition-all active:scale-[0.98]">
                Sign In
            </button>
        </form>

        <p class="text-center text-xs text-on-surface-variant mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary hover:underline font-medium">Register</a>
        </p>
    </div>
</x-guest-layout>
