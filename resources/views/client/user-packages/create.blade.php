<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create User Package') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
        <div class="max-w-xl">
            <section>
                <form method="post" action="{{ route('client.user-packages.store') }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-2">
                        {{-- <x-form.label for="user_id" :value="__('User ID')" /> --}}

                        <x-form.input id="user_id" name="user_id" type="hidden" class="block w-full"
                            :value="auth()->user()->id" required />

                        <x-form.error :messages="$errors->get('user_id')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="price" :value="__('Title')" />

                        <x-form.input id="title" name="title" type="text" class="block w-full"
                            :value="old('title')" required />

                        <x-form.error :messages="$errors->get('price')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="price" :value="__('Price')" />

                        <x-form.input id="price" name="price" type="number" class="block w-full"
                            :value="old('price')" required />

                        <x-form.error :messages="$errors->get('price')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="duration" :value="__('Duration')" />

                        <x-form.input id="duration" name="duration" type="number" class="block w-full"
                            :value="old('duration')" required />

                        <x-form.error :messages="$errors->get('duration')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="available" :value="__('Available')" />

                        <select id="available" name="available" class="block w-full" required>
                            <option value="1" {{ old('available') == 1 ? 'selected' : '' }}>
                                {{ __('Yes') }}
                            </option>
                            <option value="0" {{ old('available') == 0 ? 'selected' : '' }}>
                                {{ __('No') }}
                            </option>
                        </select>

                        <x-form.error :messages="$errors->get('available')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-button>
                            {{ __('Save') }}
                        </x-button>

                        @if (session('status') === 'package-created')
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
