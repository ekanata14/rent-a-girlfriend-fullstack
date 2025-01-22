<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create Order') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
        <div class="max-w-xl">
            <section>
                <form method="post" action="{{ route('client.orders.store') }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-2">
                        {{-- <x-form.label for="package_id" :value="__('Package ID')" /> --}}

                        <x-form.input id="package_id" name="package_id" type="hidden" class="block w-full"
                            :value="old('package_id', $package->id)" required />

                        <x-form.error :messages="$errors->get('package_id')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.input id="user_id" name="user_id" type="hidden" class="block w-full"
                            :value="auth()->user()->id" required />

                        <x-form.error :messages="$errors->get('user_id')" />
                    </div>
                    <div class="space-y-2">
                        <x-form.label for="payment_receipt" :value="__('Payment Receipt')" />

                        <x-form.input id="payment_receipt" name="payment_receipt" type="file" class="block w-full"
                            required />

                        <x-form.error :messages="$errors->get('payment_receipt')" />
                    </div>


                    <div class="space-y-2">
                        <x-form.label for="total_price" :value="__('Date')" />

                        {{-- <h2 class="text-xl font-bold" id="total_price">{{ $package->user->username }}</h2> --}}
                        <input type="date" id="date" name="date" />

                        <x-form.error :messages="$errors->get('total_price')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="total_price" :value="__('Lovely Partner')" />

                        <h2 class="text-xl font-bold" id="total_price">{{ $package->user->username }}</h2>
                        {{-- <input type="hidden" id="total_price_input" name="total_price" value="0" /> --}}

                        <x-form.error :messages="$errors->get('total_price')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="total_price" :value="__('Duration')" />

                        <h2 class="text-xl font-bold" id="total_price">{{ $package->duration }} Hour(s)</h2>
                        <input type="hidden" id="total_price_input" name="total_price" value="0" />

                        <x-form.error :messages="$errors->get('total_price')" />
                    </div>

                    <div class="space-y-2">
                        <x-form.label for="total_price" :value="__('Total Price')" />

                        <h2 class="text-xl font-bold" id="total_price">
                            IDR {{ number_format($package->price, 0, ',', '.') }}</h2>
                        <input type="hidden" id="total_price_input" name="total_price" value="{{ $package->price }}" />

                        <x-form.error :messages="$errors->get('total_price')" />
                    </div>

                    {{-- <div class="space-y-2">
                        <x-form.label for="status" :value="__('Status')" />

                        <select id="status" name="status" class="block w-full" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}
                            </option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                {{ __('Completed') }}
                            </option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                {{ __('Cancelled') }}
                            </option>
                        </select>

                        <x-form.error :messages="$errors->get('status')" />
                    </div> --}}

                    <div class="flex items-center gap-4">
                        <x-button>
                            {{ __('Order') }}
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
