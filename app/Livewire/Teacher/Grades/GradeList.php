<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class GradeList extends Component
{
    public $confirmingDelete = null;

    public function confirmDelete()
    {
        if ($this->confirmingDelete) {
            Grade::findOrFail($this->confirmingDelete)->delete();
            $this->confirmingDelete = null;

            Toaster::success("Student deleted successfully");
            return redirect()->route("grade.index");
        }
    }

    public function render()
    {
        return view('livewire.teacher.grades.grade-list',[
            'grades'=> Grade::all(),
        ]);
    }
}
