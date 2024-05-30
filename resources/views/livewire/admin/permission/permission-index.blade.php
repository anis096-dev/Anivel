<div wire:init="loadItems">

    <div wire:loading class="w-full">
        <div class="flex justify-center items-center mt-32">
            <x-svg.svg-spinner class="w-24 h-24 fill-primary-700 dark:fill-primary-400"/>
        </div>
    </div>

    <x-slot name="header">
        {{ __('permissions') }}
    </x-slot>

    <div class="py-12">
        <div class="pr-0 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-5 overflow-hidden text-gray-800 shadow-xl lg:px-0 sm:px-10 bg-gray-50 sm:rounded-lg lg:rounded-3xl dark:bg-gray-900 dark:text-gray-400">
                <div class="flex flex-wrap items-center">
                    <div class="relative flex-row flex-1 w-full max-w-full px-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300"> {{ __('permissions') }}</h3>
                            </div>
                        </div>

                        <div class="relative grid grid-cols-6 gap-6 mt-2">

                            <div class="col-span-3 md:col-span-2 lg:col-span-2">
                                <x-label class="text-xs" for="search" value="{{ __('search') }}"/>
                                <x-input wire:model.live="term" id="search" type="text" class="block w-full mt-1"
                                            autocomplete="off"/>
                            </div>

                            <div class="col-span-3 md:col-span-2 lg:col-span-1">
                                <x-label class="text-xs" for="select" value="{{ __('OrderBy') }}"/>
                                <x-select wire:model.live="orderBy" class="mt-1">
                                    <option value="id">{{ __('id') }}</option>
                                    <option value="name">{{ __('name') }}</option>
                                    <option value="key">{{ __('key') }}</option>
                                    <option value="table_name">{{ __('table_name') }}</option>
                                    @if($trashed)
                                        <option value="deleted_at">{{ __('deleted_at') }}</option>
                                    @else
                                        <option value="created_at">{{ __('created_at') }}</option>
                                        <option value="updated_at">{{ __('updated_at') }}</option>
                                    @endif

                                </x-select>
                            </div>

                            <div class="col-span-3 md:col-span-2 lg:col-span-1">
                                <x-label class="text-xs" for="select" value="{{ __('PerPage') }}"/>
                                <x-select wire:model.live="perPage" class="mt-1">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </x-select>
                            </div>

                            <div class="col-span-3 md:col-span-2 lg:col-span-1">
                                <x-label class="text-xs" for="select" value="{{ __('SortBy') }}"/>
                                <x-select wire:model.live="sortBy" class="mt-1">
                                    <option value="asc">{{ __('ASC') }}</option>
                                    <option value="desc">{{ __('DESC') }}</option>
                                </x-select>
                            </div>

                            <div class="col-span-3 md:col-span-2 lg:col-span-2">
                                <x-label class="text-xs" for="trashed" value="{{ __('Show Trashed') }}"/>
                                <x-checkbox wire:model.live="trashed" value="true" class="block mt-3 w-7 h-7"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full px-0 overflow-hidden mt-7">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                            <tr class="text-sm font-semibold text-gray-500 border-y text-left dark:border-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700/30">
                                <th class="w-10 px-2 py-3 text-center">{{ __('id') }}</th>
                                <th class="px-2 py-3 text-center"> {{ __('name') }}</th>
                                <th class="px-2 py-3 text-center">{{ __('key') }}</th>
                                <th class="px-2 py-3 text-center">{{ __('table_name') }}</th>
                                <th class="px-2 py-3 text-center">{{ $trashed ? __('deleted_at') : __('created_at') }}</th>
                                <th class="px-2 py-3 text-center">{{ __('actions') }}</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-900">
                            @forelse($permissions as $permission)
                                <tr class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 hover:dark:text-gray-200 hover:bg-gray-100 hover:dark:bg-gray-700">
                                    <td class="px-2 py-3 text-center text-sm">
                                        {{ $permission->id }}
                                    </td>
                                    <td class="px-2 py-3 text-sm text-center lowercase">
                                        {{ $permission->name }}
                                    </td>
                                    <td class="px-2 py-3 text-sm text-center lowercase">
                                        {{ $permission->key }}
                                    </td>
                                    <td class="px-2 py-3 text-sm text-center lowercase">
                                        {{ $permission->table_name }}
                                    </td>
                                    <td class="px-2 py-3 text-sm text-center">
                                        {{ $trashed ? $permission->deleted_at->diffForHumans() : $permission->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-between gap-1 text-sm text-center">

                                            @if($trashed)
                                                @can('restore', $permission)
                                                    <x-button2 wire:click="selectedItem('restore',{{ $permission->id }})"
                                                                  class="px-2">
                                                        <x-svg.svg-restore class="w-5 h-5"/>
                                                    </x-button2>
                                                @endcan

                                                @can('forceDelete', $permission)
                                                    <x-button2
                                                            wire:click="selectedItem('forceDelete',{{ $permission->id }})"
                                                            class="px-2">
                                                        <x-svg.svg-force-delete class="w-5 h-5"/>
                                                    </x-button2>
                                                @endcan

                                            @else
                                                @can('delete', $permission)
                                                    <x-button2 wire:click="selectedItem('delete',{{ $permission->id }})"
                                                                  class="px-2">
                                                        <x-svg.svg-delete class="w-5 h-5"/>
                                                    </x-button2>
                                                @endcan

                                            @endif


                                        </div>
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="7"
                                        class="px-4 py-3 text-sm text-center text-gray-700 dark:text-gray-400">{{ __('No Data') }}</td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(!empty($permissions))
                        <div class="px-4 py-3 border-t dark:border-gray-700">
                            {{ $permissions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.permission.permission-delete/>
</div>