<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title("Student Attendance | Add Student")]

class AddStudent extends Component
{
    public $name = '';
    public $phone = '';
    public $email = '';
    public $grade_id = '';
    public $password = '';
    public $confirm_password = '';
    public $grades = [];

    public function save()
    {

        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'grade_id' => 'required',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $user->assignRole('student');

        Student::create([
            'phone' => $this->phone,
            'grade_id' => $this->grade_id,
        ]);

        $this->reset();

        Toaster::success('Student added successfully');

        return redirect()->route('student.index');
    }

    public function mount()
    {
        $this->grades = Grade::all();
    }

    public function render()
    {
        return view('livewire.teacher.students.add-student');
    }
}
