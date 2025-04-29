<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title("Student Attendance | Add Student")]

class AddStudent extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $phone = '';
    public $email = '';
    public $grade_id = '';
    public $password = '';
    public $confirm_password = '';
    public $grades = [];

    public function save()
    {



        $data =  $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer',
            'grade_id' => 'required',
        ]);

        Student::create($data);
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
