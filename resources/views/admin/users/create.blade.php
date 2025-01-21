<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
        <div class="max-w-xl">
            <section>
                <form method="post" action="{{ route('admin.users.store') }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-2">
                        <x-form.label for="username" :value="__('Username')" />

                        <x-form.input id="username" name="username" type="text" class="block w-full"
                            :value="old('username')" required autofocus autocomplete="username" />

                        <x-form.error :messages="$errors->get('username')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="email" :value="__('Email')" />

                        <x-form.input id="email" name="email" type="email" class="block w-full"
                            :value="old('email')" required autocomplete="email" />

                        <x-form.error :messages="$errors->get('email')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="password" :value="__('Password')" />

                        <x-form.input id="password" name="password" type="password" class="block w-full"
                            required autocomplete="new-password" />

                        <x-form.error :messages="$errors->get('password')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="age" :value="__('Age')" />

                        <x-form.input id="age" name="age" type="number" class="block w-full"
                            :value="old('age')" required />

                        <x-form.error :messages="$errors->get('age')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="height" :value="__('Height')" />

                        <x-form.input id="height" name="height" type="number" class="block w-full"
                            :value="old('height')" required />

                        <x-form.error :messages="$errors->get('height')" />
                    </div>

                    @if (auth()->user()->role == 0)
                        <div class="space-y-2">
                            <x-form.label for="role" :value="__('Role')" />

                            <select id="role" name="role" class="block w-full" required>
                                <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>
                                    {{ __('Admin') }}
                                </option>
                                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>
                                    {{ __('User') }}
                                </option>
                            </select>

                            <x-form.error :messages="$errors->get('role')" />
                        </div>
                    @endif

                    <div class="space-y-2">
                        <x-form.label for="gender" :value="__('Gender')" />

                        <select id="gender" name="gender" class="block w-full" required>
                            <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>
                                {{ __('Male') }}
                            </option>
                            <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>
                                {{ __('Female') }}
                            </option>
                        </select>

                        <x-form.error :messages="$errors->get('gender')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="mobile_phone" :value="__('Mobile Phone')" />

                        <x-form.input id="mobile_phone" name="mobile_phone" type="text" class="block w-full"
                            :value="old('mobile_phone')" required />

                        <x-form.error :messages="$errors->get('mobile_phone')" />
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

                        @if (session('status') === 'profile-created')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Created.') }}
                            </p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
