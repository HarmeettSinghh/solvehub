<x-app-layout>
    <div class="px-6 py-8 max-w-4xl mx-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-on-surface">Account Settings</h1>
            <p class="text-base text-on-surface-variant mt-1">Manage your profile information, password, and account settings.</p>
        </header>

        <div class="space-y-6">
            {{-- Profile Info Card --}}
            <div class="p-6 sm:p-8 bg-surface-container border border-outline-variant rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Password Update Card --}}
            <div class="p-6 sm:p-8 bg-surface-container border border-outline-variant rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="p-6 sm:p-8 bg-surface-container border border-outline-variant rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
