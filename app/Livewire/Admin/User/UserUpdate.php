<?php

namespace App\Livewire\Admin\User;

use App\Models\City;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Hash;

class UserUpdate extends Component
{
    public $countries;
    public $roles;
    public $cities = [];

    public $itemId;

    public $name, $email, $countryId,
        $cityId, $roleId, $password, $password_confirmation, $profile_photo_path;


    protected $listeners = ['showUpdateModel'];

    public bool $showUpdateModel = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email,'.$this->itemId],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'countryId' => 'required|integer|exists:App\Models\Country,id',
            'cityId' => 'required|integer|exists:App\Models\City,id',
            'roleId' => 'required|integer|exists:App\Models\Role,id',
        ];
    }

    public function mount($countries, $roles){
        $this->countries = $countries;
        $this->roles = $roles;
        $this->cities = City::all()->pluck('name' , 'id');
    }

    public function showUpdateModel($itemId){
        $this->itemId = $itemId;
        $this->showUpdateModel = true;

        if (!empty($this->itemId)){
            $item = User::find($this->itemId);
            $this->name = $item->name;
            $this->email = $item->email;
            $this->countryId = $item->country_id;
            $this->cityId = $item->city_id;
            $this->roleId = $item->role_id;
            $this->profile_photo_path = $item->profile_photo_url;

            $this->cities = City::where('country_id',$this->countryId)->pluck('name','id');
        }
    }

    public function closeUpdateModel(){
        $this->showUpdateModel = false;
        $this->resetExcept('countries','roles', 'cities');
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function edit(){
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->roleId,
            'country_id' => $this->countryId,
            'city_id' => $this->cityId,
        ];

        if (!empty($this->password)){
            $data['password'] = Hash::make($this->password);
        }

        User::where('id',$this->itemId)->update($data);
        $this->closeUpdateModel();
        $this->resetExcept('countries','roles', 'cities');
        Toaster::success('User updated!'); // 👈
        $this->dispatch('refreshParent');

    }

    public function updatedCountryId($value){

        if (!empty($value)){
            $this->cities = City::where('country_id',$value)->pluck('name','id');
        }
    }

    public function updatedPassword()
    {
        $this->validate([
            'password' => 'string|min:8|confirmed',
        ]);
    }
    
    public function render()
    {
        return view('livewire.admin.user.user-update');
    }
}
