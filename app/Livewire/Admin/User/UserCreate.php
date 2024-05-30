<?php

namespace App\Livewire\Admin\User;

use App\Models\City;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $countries;
    public $roles;
    public $cities = [];

    public $name, $email, $countryId,
        $cityId, $roleId, $password, $password_confirmation;


    protected $listeners = ['showCreateModel'];

    public bool $showCreateModel = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'countryId' => 'required|integer|exists:App\Models\Country,id',
            'cityId' => 'required|integer|exists:App\Models\City,id',
            'roleId' => 'required|integer|exists:App\Models\Role,id',
        ];
    }

    public function mount($countries, $roles){
        $this->countries = $countries;
        $this->roles = $roles;
    }

    public function showCreateModel(){
        $this->showCreateModel = true;
    }

    public function closeCreateModel(){
        $this->showCreateModel = false;
        $this->resetExcept('countries','roles');
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function create(){
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->roleId,
            'country_id' => $this->countryId,
            'city_id' => $this->cityId,
        ];

        User::create($data);
        $this->closeCreateModel();
        Toaster::success('User created!'); // 👈
        $this->dispatch('refreshParent');

    }

    public function updatedCountryId($value){

        if (!empty($value)){
            $this->cities = City::where('country_id',$value)->pluck('name','id');
        }
    }

    public function render()
    {
        return view('livewire.admin.user.user-create');
    }
}
