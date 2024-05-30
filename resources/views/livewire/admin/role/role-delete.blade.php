<div>
    <x-confirmation-modal wire:model="showDeleteModel">
        <x-slot name="title">
            {{ __('delete') }} {{ __('role') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete role?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeDeleteModel" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="mr-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>


    <x-confirmation-modal wire:model="showRestoreModel">
        <x-slot name="title">
            {{ __('restore') }} {{ __('role') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to restore role?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeRestoreModel" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="restore" wire:loading.attr="disabled">
                {{ __('restore') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>



    <x-confirmation-modal wire:model="showForceDeleteModel">
        <x-slot name="title">
            {{ __('delete') }} {{ __('role') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete role permantly?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeForceDeleteModel" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="forceDelete" wire:loading.attr="disabled">
                {{ __('delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>