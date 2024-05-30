<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link wire:navigate href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
        {{ __('Dashboard') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link wire:navigate href="{{ route('admin.user.index') }}" :active="request()->routeIs('admin.user.index')">
        {{ __('Users') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link wire:navigate href="{{ route('admin.role.index') }}" :active="request()->routeIs('admin.role.index')">
        {{ __('Roles') }}
    </x-responsive-nav-link>
</div>
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link wire:navigate href="{{ route('admin.permission.index') }}" :active="request()->routeIs('admin.permission.index')">
        {{ __('Permisssions') }}
    </x-responsive-nav-link>
</div>