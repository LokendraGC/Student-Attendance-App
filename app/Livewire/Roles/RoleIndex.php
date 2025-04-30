<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;


class RoleIndex extends Component
{
    public $role_emails = '';
    public $confirmingDelete = null;


    public function mount()
    {
        $this->role_emails = Role::with('users')->get();
    }

    public function confirmDelete()
    {
        if ($this->confirmingDelete) {
            Role::findOrFail($this->confirmingDelete)->delete();
            $this->confirmingDelete = null;


            Toaster::success("Role deleted successfully");
            return redirect()->route("role.index");
        }
    }

    public function render()
    {
        $roles = Role::with("permissions")->get();
        return view('livewire.roles.role-index', compact('roles'));
    }
}
