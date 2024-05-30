<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleCreate extends Component
{
    use AuthorizesRequests;

    public $permissions;

    public $name, $key,$color = 'bg-gray-700 text-white' , $permission = [];

    public bool $showCreateModel = false;

    protected $listeners = ['showCreateModel'];

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50', 'min:5', Rule::unique(Role::class)],
            'key' => ['required', 'string', 'min:5', 'max:20', Rule::unique(Role::class)],
            'color' => ['required', 'string', 'min:5','max:255', Rule::unique(Role::class)],
            'permission' => ['required', 'array'],
        ];
    }

    public function mount($permissions){
        $this->permissions = $permissions;

    }

    public function showCreateModel(){
        $this->showCreateModel = true;
    }

    public function closeCreateModel(){
        $this->showCreateModel = false;
        $this->resetExcept('permissions');
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function create(){
        $this->authorize('create',Role::class);

        $this->validate();

        $data = [
            'name' => $this->name,
            'key' => $this->key,
            'color' => $this->color,
        ];

        $role = Role::create($data);

        if (!empty($this->permission)){
            $permissionsId = Permission::whereIn('id', $this->permission)->pluck('id');
            $role->permission()->attach($permissionsId);
        }

        $this->closeCreateModel();
        Toaster::success('User created!'); // 👈
        $this->dispatch('refreshParent');

    }

    public function updatingColor($value){
        $this->color = $value;
    }
    
    public function render()
    {
        return view('livewire.admin.role.role-create');
    }
}
