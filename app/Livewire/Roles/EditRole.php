<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class EditRole extends Component
{
    public $selectedPermissions = [];
    public $allPermissions;
    public $name;
    public $role_id;
    public $role;

    public function mount($id)
    {
        $this->role = Role::findOrFail($id);
        $this->allPermissions = Permission::all();

        $this->fill([
            'role_id' => $this->role->id,
            'name' => $this->role->name,
            'selectedPermissions' => $this->role->permissions->pluck('name')->toArray(),
        ]);
    }

    public function updateRole()
    {
        $validated = $this->validate([
            'name' => 'required|unique:roles,name,'.$this->role_id,
            'selectedPermissions' => 'array',
        ]);

        // Update role name
        $this->role->update(['name' => $validated['name']]);

        // Sync permissions
        $this->role->syncPermissions($validated['selectedPermissions']);

        Toaster::success('Role updated successfully');
        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.roles.edit-role');
    }
}
