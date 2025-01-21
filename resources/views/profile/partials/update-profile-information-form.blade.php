<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-form.label for="name" :value="__('Name')" />

            <x-form.input id="username" name="username" type="text" class="block w-full" :value="old('name', $user->username)" required
                autofocus autocomplete="name" />

            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="email" :value="__('Email')" />

            <x-form.input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required
                autocomplete="email" />

            <x-form.error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="space-y-2">
            <x-form.label for="age" :value="__('Age')" />

            <x-form.input id="age" name="age" type="number" class="block w-full" :value="old('age', $user->age)"
                required />

            <x-form.error :messages="$errors->get('age')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="height" :value="__('Height')" />

            <x-form.input id="height" name="height" type="number" class="block w-full" :value="old('height', $user->height)"
                required />

            <x-form.error :messages="$errors->get('height')" />
        </div>

        @if (auth()->user()->role == 0)
            <div class="space-y-2">
                <x-form.label for="role" :value="__('Role')" />

                <select id="role" name="role" class="block w-full" required>
                    <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>{{ __('Admin') }}
                    </option>
                    <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>{{ __('User') }}
                    </option>
                </select>

                <x-form.error :messages="$errors->get('role')" />
            </div>
        @endif

        <div class="space-y-2">
            <x-form.label for="gender" :value="__('Gender')" />

            <select id="gender" name="gender" class="block w-full" required>
                <option value="0" {{ old('gender', $user->gender) == 0 ? 'selected' : '' }}>{{ __('Male') }}
                </option>
                <option value="1" {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>{{ __('Female') }}
                </option>
            </select>

            <x-form.error :messages="$errors->get('gender')" />
        </div>

        <div class="space-y-2">
            <x-form.label for="mobile_phone" :value="__('Mobile Phone')" />

            <x-form.input id="mobile_phone" name="mobile_phone" type="text" class="block w-full" :value="old('mobile_phone', $user->mobile_phone)"
                required />

            <x-form.error :messages="$errors->get('mobile_phone')" />
        </div>
        <div class="space-y-2">
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture">
        </div>

        <div class="space-y-2">
            <x-form.label for="profile_picture" :value="__('Profile Picture')" />

            <x-form.input id="profile_picture" name="profile_picture" type="file" class="block w-full" />

            <x-form.error :messages="$errors->get('profile_picture')" />
        </div>

        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
