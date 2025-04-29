<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditStudent extends Component
{
    public $name = '';
    public $phone = '';
    public $email = '';
    public $grade_id = '';
    public $grades = [];
    public $role_student;
    public $student_id = '';

    public function mount($id)
    {
        $user = User::with('student.grade')->findOrFail($id);

        if (!$user->hasRole('student')) {
            abort(403, 'User is not a student');
        }

        $this->role_student = $user;
        $student = $user->student;

        // Store the student ID for update()
        $this->student_id = $student->id ?? null;

        $this->fill([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $student->phone ?? '',
            'grade_id' => $student->grade_id ?? '',
        ]);

        $this->grades = Grade::all();
    }

    public function update()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->role_student->id,
            'phone' => 'required|string|max:20',
            'grade_id' => 'required',
        ]);

        // Update the User
        $this->role_student->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        // Update the Student
        Student::findOrFail($this->student_id)->update([
            'phone' => $data['phone'],
            'grade_id' => $data['grade_id'],
        ]);

        Toaster::success('Student updated successfully');

        return redirect()->route('student.index');
    }


    public function render()
    {
        return view('livewire.teacher.students.edit-student');
    }
}
