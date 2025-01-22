<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Rate') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
        <div class="max-w-xl">
            <section>
                <form method="post" action="{{ route('client.ratings.store') }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-2">
                        <x-form.input id="gf_bf_id" name="gf_bf_id" type="hidden" class="block w-full"
                            :value="old('gf_bf_id', $order->package->user_id)" required />

                        <x-form.error :messages="$errors->get('gf_bf_id')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.input id="user_id" name="user_id" type="hidden" class="block w-full"
                            :value="auth()->user()->id" required />

                        <x-form.error :messages="$errors->get('user_id')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.input id="order_id" name="order_id" type="hidden" class="block w-full"
                            :value="$order->id" required />

                        <x-form.error :messages="$errors->get('user_id')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="rate" :value="__('Rate')" />

                        <select id="rate" name="rate" class="block w-full" required>
                            <option value="1" {{ old('rate') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('rate') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('rate') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('rate') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('rate') == '5' ? 'selected' : '' }}>5</option>
                        </select>

                        <x-form.error :messages="$errors->get('rate')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="review" :value="__('Review')" />

                        <x-form.input id="review" name="review" type="text" class="block w-full"
                            :value="old('review')" required />

                        <x-form.error :messages="$errors->get('review')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-button>
                            {{ __('Submit') }}
                        </x-button>

                        @if (session('status') === 'review-created')
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
