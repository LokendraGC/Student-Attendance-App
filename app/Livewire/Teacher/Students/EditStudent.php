<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditStudent extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $age = '';
    public $email = '';
    public $grade_id = '';
    public $grades = [];

    public $student_id;

    public function mount($id)
    {
        $student = Student::find($id);
        $this->student_id = $student->id;

        $this->fill([
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'grade_id' => $student->grade_id,
            'age' => $student->age,
            'email' => $student->email,
        ]);

        $this->grades = Grade::all();
    }

    public function update()
    {
        $data =  $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $this->student_id,
            'age' => 'required|integer',
            'grade_id' => 'required',
        ]);

        Student::findOrFail($this->student_id)->update($data);

        Toaster::success('Student updated successfully');

        return redirect()->route('student.index');

    }

    public function render()
    {
        return view('livewire.teacher.students.edit-student');
    }
}
