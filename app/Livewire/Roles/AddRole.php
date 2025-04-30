<?php

namespace App\Livewire\Roles;

use Illuminate\Support\Facades\Auth;
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
        // this code is for prevent the accessing the route if it is not admin or teacher
        if( !Auth::user()->hasRole(['admin','teacher']) ){
            abort(403);
        }

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
