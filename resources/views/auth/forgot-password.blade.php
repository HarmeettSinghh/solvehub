<x-guest-layout>
    <div class="bg-surface-container border border-outline-variant rounded-lg p-8">
        <h2 class="text-xl font-semibold text-on-surface mb-4 text-center">Reset Password</h2>
        <p class="text-sm text-on-surface-variant text-center mb-6">Enter your email and we'll send you a password reset link.</p>

        @if (session('status'))
            <div class="mb-4 text-sm text-primary bg-primary-container/10 border border-primary-container/30 rounded p-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold block mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-3 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                       placeholder="your@email.com"/>
                @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-lg text-sm font-bold hover:opacity-90 transition-all active:scale-[0.98]">
                Send Reset Link
            </button>
        </form>

        <p class="text-center text-xs text-on-surface-variant mt-6">
            <a href="{{ route('login') }}" class="text-primary hover:underline">← Back to Sign In</a>
        </p>
    </div>
</x-guest-layout>
