<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use App\Models\Permission;
use Masmerise\Toaster\Toaster;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PermissionDelete extends Component
{
    use AuthorizesRequests;


    public $showDeleteModel = false;
    public $showRestoreModel = false;
    public $showForceDeleteModel = false;
    public $itemId;

    protected $listeners = ['showDeleteModel','showRestoreModel','showForceDeleteModel'];

    public function showDeleteModel($itemId){
        $this->itemId = $itemId;
        $this->showDeleteModel = true;
    }

    public function closeDeleteModel(){
        $this->showDeleteModel = false;
        $this->reset();
    }

    public function delete(){
        $permission = Permission::findOrFail($this->itemId);
        $this->authorize('delete', $permission);
        $permission->delete();
        $this->reset();
        $this->closeDeleteModel();
        $this->dispatch('refreshParent');
        Toaster::success('Permission deleted!'); // 👈
    }

    public function showRestoreModel($itemId){
        $this->itemId = $itemId;
        $this->showRestoreModel = true;
    }

    public function closeRestoreModel(){
        $this->showRestoreModel = false;
        $this->reset();
    }
    public function restore(){
        $permission = Permission::onlyTrashed()->findOrFail($this->itemId);
        $this->authorize('restore', $permission);
        $permission->restore();
        $this->reset();
        $this->closeRestoreModel();
        $this->dispatch('refreshParent');
        Toaster::success('Permission restored!'); // 👈
    }

    public function showForceDeleteModel($itemid){
        $this->itemId = $itemid;
        $this->showForceDeleteModel = true;
    }
    public function closeForceDeleteModel(){
        $this->showForceDeleteModel = false;
        $this->reset();
    }

    public function forceDelete(){
        $permission = Permission::onlyTrashed()->findOrFail($this->itemId);
        $this->authorize('forceDelete', $permission);
        $permission->forceDelete();
        $this->reset();
        $this->closeForceDeleteModel();
        $this->dispatch('refreshParent');
        Toaster::success('Permission deleted Permently!'); // 👈
    }
    
    public function render()
    {
        return view('livewire.admin.permission.permission-delete');
    }
}
