<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Student;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentList extends Component
{
    public $confirmingDelete = null;

    public function confirmDelete()
    {
        if ($this->confirmingDelete) {
            Student::findOrFail($this->confirmingDelete)->delete();
            $this->confirmingDelete = null;

            Toaster::success("Student deleted successfully");
            return redirect()->route("student.index");
        }
    }

    public function render()
    {
        return view('livewire.teacher.students.student-list', [
            'students' => Student::all(),
        ]);
    }
}
