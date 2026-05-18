<section>
    <header>
        <h2 class="text-lg font-semibold text-on-surface">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-on-surface-variant">
            Update your account's profile details, bio, location, and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Avatar Upload --}}
        <div class="space-y-1">
            <x-input-label for="avatar" value="Profile Avatar" />
            <div class="flex items-center gap-4 mt-1">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-12 h-12 rounded-xl object-cover border border-outline-variant">
                @else
                    <div class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-lg border border-outline-variant">
                        {{ $user->initials }}
                    </div>
                @endif
                <input id="avatar" name="avatar" type="file" accept="image/*"
                       class="text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-mono file:font-bold file:bg-surface-container-highest file:text-on-surface hover:file:opacity-90 file:cursor-pointer"/>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        {{-- Name --}}
        <div class="space-y-1">
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div class="space-y-1">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-xs text-on-surface-variant">
                        Your email address is unverified.
                        <button form="send-verification" class="underline text-primary hover:text-primary/80">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs text-primary font-mono">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Location --}}
        <div class="space-y-1">
            <x-input-label for="location" value="Location" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" placeholder="e.g. San Francisco, CA" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        {{-- Bio --}}
        <div class="space-y-1">
            <x-input-label for="bio" value="Bio" />
            <textarea id="bio" name="bio" rows="4"
                      class="mt-1 block w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50"
                      placeholder="Tell the community about yourself...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-mono text-primary"
                >Saved successfully.</p>
            @endif
        </div>
    </form>
</section>
