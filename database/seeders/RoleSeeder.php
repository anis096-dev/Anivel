<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'Administrator',
            'key' => 'administrator',
            'color' => 'bg-red-700 text-white',
        ]);

        Role::firstOrCreate([
            'name' => 'Admin',
            'key' => 'admin',
            'color' => 'bg-orange-400 text-black',
        ]);

        Role::firstOrCreate([
            'name' => 'Moderator',
            'key' => 'moderator',
            'color' => 'bg-green-500 text-white',
        ]);

        Role::firstOrCreate([
            'name' => 'User',
            'key' => 'user',
            'color' => 'bg-gray-100 text-black',
        ]);

        Role::firstOrCreate([
            'name' => 'Banned',
            'key' => 'banned',
            'color' => 'bg-gray-500 text-white',
        ]);

        $permission_administrator = Permission::where('key','!=','banned')->pluck('id')->toArray();

        $admin_role = Role::where('key','administrator')->first();
        $admin_role->permission()->sync($permission_administrator);
    }
}
