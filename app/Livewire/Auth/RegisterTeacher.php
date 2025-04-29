<?php

namespace App\Livewire\Auth;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules;
use Masmerise\Toaster\Toaster;

#[Layout('components.layouts.auth')]
class RegisterTeacher extends Component
{

    public $name = '';
    public $email = '';
    public $phone = '';
    public $qualification = '';
    public $description = '';
    public $password = '';
    public $password_confirmation = '';



    public function register()
    {

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:14'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]))));

        $user->assignRole('teacher');

        $user->teacher()->create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'qualification' => $this->qualification,
            'description' => $this->description,
        ]);

        Toaster::success('User has registerd successfully');

        Auth::login($user);

        $this->redirect(route('teacher.dashboard', absolute: false), navigate: true);
    }



    public function render()
    {
        return view('livewire.auth.register-teacher');
    }
}
