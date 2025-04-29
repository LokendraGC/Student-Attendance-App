<?php

namespace App\Livewire\Auth;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('components.layouts.auth')]
class Register extends Component
{

    public string $email = '';
    public string $password = '';
    public $name = '';
    public $last_name = '';
    public $phone = '';
    public $grade_id = '';
    public string $password_confirmation = '';
    public $grades;

    public function mount()
    {
        $this->grades = Grade::all();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:14'],
            'grade_id' => ['required', 'integer'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]))));

        $user->assignRole('student');

        $user->student()->create([
            'first_name' => $validated['name'],
            'phone' => $validated['phone'],
            'grade_id' => $validated['grade_id'],
        ]);

        Toaster::success('User has registerd successfully');

        Auth::login($user);

        $this->redirect(route('student.dashboard', absolute: false), navigate: true);
    }
}
