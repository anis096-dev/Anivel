<x-responsive-nav-link wire:navigate href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
    {{ __('Profile') }}
</x-responsive-nav-link>

<!-- Authentication -->
<form method="POST" action="{{ route('logout') }}" x-data>
    @csrf

    <x-responsive-nav-link href="{{ route('logout') }}"
                   @click.prevent="$root.submit();">
        {{ __('Log Out') }}
    </x-responsive-nav-link>
</form>