<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleDelete extends Component
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
        $role = Role::findOrFail($this->itemId);
        $this->authorize('delete', $role);
        $role->delete();
        $this->reset();
        $this->closeDeleteModel();
        $this->dispatch('refreshParent');
        Toaster::success('User deleted!'); // 👈
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
        $role = Role::onlyTrashed()->findOrFail($this->itemId);
        $this->authorize('restore', $role);
        $role->restore();
        $this->reset();
        $this->closeRestoreModel();
        $this->dispatch('refreshParent');
        Toaster::success('User restored!'); // 👈
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
        $role = Role::onlyTrashed()->findOrFail($this->itemId);
        $this->authorize('forceDelete', $role);
        $role->forceDelete();
        $this->reset();
        $this->closeForceDeleteModel();
        $this->dispatch('refreshParent');
        Toaster::success('User deleted Permently!'); // 👈
    }

    public function render()
    {
        return view('livewire.admin.role.role-delete');
    }
}
