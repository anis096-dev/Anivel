<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Role\RoleIndex;
use App\Livewire\Admin\User\UserIndex;
use App\Livewire\Admin\Admin\AdminIndex;
use App\Livewire\Admin\Permission\PermissionIndex;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/',AdminIndex::class)->name('index');
    Route::get('/users',UserIndex::class)->name('user.index')->can('viewAny', User::class);
    Route::get('/roles',RoleIndex::class)->name('role.index')->can('viewAny', Role::class);
    Route::get('/permissions',PermissionIndex::class)->name('permission.index')->can('viewAny', Permission::class);
});
