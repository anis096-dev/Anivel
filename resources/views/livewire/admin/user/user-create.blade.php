<div>
    <x-dialog-modal wire:model="showCreateModel">
        <x-slot name="title">
            {{ __('create') }} {{ __('user') }}
        </x-slot>

        <form wire:submit.prevent="create" autocomplete="off">

            <x-slot name="content">
                <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">

                    <div class="col-span-4 lg:col-span-3">
                        <x-label for="name" value="{{ __('name') }}"/>
                        <x-input wire:model.defer="name" id="name" type="text" class="mt-1 block w-full" />
                        <x-input-error for="name" class="mt-2"/>
                    </div>

                    <div class="col-span-4 lg:col-span-3">
                        <x-label for="email" value="{{ __('email') }}"/>
                        <x-input wire:model.defer="email" type="email" class="mt-1 block w-full"/>
                        <x-input-error for="email" class="mt-2"/>
                    </div>

                    <div class="col-span-4 lg:col-span-3">
                        <x-label class="text-xs" for="select" value="{{ __('country') }}"/>
                        <x-select wire:model.live="countryId" wire:key="countryCreate" class="mt-1">
                            <option value="" readonly="true" hidden="true"
                                    selected>{{ __('select country') }}</option>
                            @forelse($countries as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @empty
                            @endforelse
                        </x-select>
                        <x-input-error for="countryId" class="mt-2"/>
                    </div>

                    <div class="col-span-4 lg:col-span-3">
                        <x-label class="text-xs" for="select" value="{{ __('city') }}"/>
                        <x-select wire:model.live="cityId" wire:key="cityCreate" class="mt-1">
                            <option value="" readonly="true" hidden="true"
                                    selected>{{ __('select city') }}</option>
                            @forelse($cities as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @empty
                            @endforelse
                        </x-select>
                        <x-input-error for="cityId" class="mt-2"/>
                    </div>

                    <div class="col-span-4 lg:col-span-3">
                        <x-label class="text-xs" for="roleId" value="{{ __('role') }}"/>
                        <x-select wire:model.live="roleId" wire:key="roleCreate" class="mt-1">
                            <option value="" readonly="true" hidden="true"
                                    selected>{{ __('select role') }}</option>
                            @forelse($roles as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @empty
                            @endforelse
                        </x-select>
                        <x-input-error for="roleId" class="mt-2"/>
                    </div>

                    <div class="col-span-4 lg:col-span-3">
                        <x-label for="password" value="{{ __('password') }}"/>
                        <x-input wire:model.defer="password" type="password" class="mt-1 block w-full"/>
                        <x-input-error for="password" class="mt-2"/>
                    </div>

                    <div class="col-span-4 lg:col-span-3">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                        <x-input wire:model.defer="password_confirmation"
                            class="block mt-1 w-full" type="password"
                            required autocomplete="new-password"/>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="closeCreateModel" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-button type="submit" wire:click="create" wire:loading.attr="disabled" class="ml-3">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </form>

    </x-dialog-modal>
</div>