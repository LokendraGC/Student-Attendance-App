<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRole extends Component
{

    public $selectedPermissions = [];
    public $allPermissions = '';
    public $name = '';


    public function mount()
    {
        $this->allPermissions = Permission::all();
    }

    public function createRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
            'selectedPermissions' => 'required',
        ]);

        $role = Role::create([
            'name' => $this->name,
        ]);

        $role->syncPermissions($this->selectedPermissions);

        Toaster::success('Role is Added');

        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.roles.add-role');
    }
}
