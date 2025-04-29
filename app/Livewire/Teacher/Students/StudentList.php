<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentList extends Component
{
    public $confirmingDelete = null;

    public $role_students = '';

    public function mount()
    {
        $this->role_students =  User::role('student')->get();
    }

    public function confirmDelete()
    {
        if ($this->confirmingDelete) {
            User::findOrFail($this->confirmingDelete)->delete();
            $this->confirmingDelete = null;

            Toaster::success("Student deleted successfully");
            return redirect()->route("student.index");
        }
    }

    public function render()
    {
        return view('livewire.teacher.students.student-list', [
            'role_students' => $this->role_students,
        ]);
    }
}
