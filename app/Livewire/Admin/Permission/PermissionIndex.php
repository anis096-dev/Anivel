<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;

class PermissionIndex extends Component
{
    use WithPagination;

    public ?string $term = null;
    public string $orderBy = 'id';
    public string $sortBy = 'asc';
    public int $perPage = 10;
    public bool $trashed = false;
    public $permissionSearch;

    protected $listeners = [ 'refreshParent' => '$refresh'];

    public $readyToLoad = false;

    public function loadItems()
    {
        $this->readyToLoad = true;
    }

    public function updatingTerm(){
        $this->resetPage();
    }

    public function updatingOrderBy(){
        $this->resetPage();
    }

    public function updatingSortBy(){
        $this->resetPage();
    }

    public function updatingPerPage(){
        $this->resetPage();
    }

    public function updatingTrashed(){
        $this->resetPage();
    }


    public function selectedItem($action ,$itemId = null){
        if ($action == 'delete'){
            $this->dispatch('showDeleteModel', $itemId);
        }elseif ($action == 'restore'){
            $this->dispatch('showRestoreModel', $itemId);
        }elseif ($action == 'forceDelete'){
            $this->dispatch('showForceDeleteModel', $itemId);
        }
    }

    public function getItem(){
        $permissions = Permission::query();
        // * Search
        if (!empty($this->term)&& $this->term != null){
            $permissions = $permissions->search(trim($this->term));
        }
        // * Trashed
        if ($this->trashed){
            $permissions = $permissions->onlyTrashed();
        }

        $permissions = $permissions->orderBy($this->orderBy, $this->sortBy)->paginate($this->perPage);

        return $permissions;

    }
    
    public function render()
    {
        return view('livewire.admin.permission.permission-index',[
            'permissions' => $this->readyToLoad ? $this->getItem() : [],
        ])->layout('layouts.admin');
    }
}
