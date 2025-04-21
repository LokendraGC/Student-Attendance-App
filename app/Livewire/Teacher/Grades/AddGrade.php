<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AddGrade extends Component
{
    public $name = '';

    public function save()
    {
        $grade_data = $this->validate([
            'name' => 'required',
        ]);

        Grade::create($grade_data);

        Toaster::success('Grade Added Successfully');

        return redirect()->route('grade.index');
    }

    public function render()
    {
        return view('livewire.teacher.grades.add-grade');
    }
}
