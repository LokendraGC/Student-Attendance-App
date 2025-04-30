<?php

namespace App\Livewire\Roles;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;


class RoleIndex extends Component
{
    public $role_emails = '';
    public $confirmingDelete = null;


    public function mount()
    {
        // this code is for prevent the accessing the route if it is not admin or teacher
        if (!Auth::user()->hasRole(['admin', 'teacher'])) {
            abort(403);
        }

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
