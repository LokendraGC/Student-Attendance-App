<?php

namespace App\Livewire\Auth;

use App\Models\Grade;
use Livewire\Component;

class RegisterTeacher extends Component
{
    public function render()
    {
        return view('livewire.auth.register-teacher',[
            'grades' => Grade::all(),
        ]);
    }
}
