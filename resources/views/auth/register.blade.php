<x-guest-layout>
    <div class="bg-surface-container border border-outline-variant rounded-lg p-8">
        <h2 class="text-xl font-semibold text-on-surface mb-6 text-center">Create Account</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                       placeholder="John Doe"/>
                @error('name') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                       placeholder="your@email.com"/>
                @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       placeholder="••••••••"/>
                @error('password') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                       placeholder="••••••••"/>
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-lg text-sm font-bold hover:opacity-90 transition-all active:scale-[0.98]">
                Create Account
            </button>
        </form>

        <p class="text-center text-xs text-on-surface-variant mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary hover:underline font-medium">Sign In</a>
        </p>
    </div>
</x-guest-layout>
