<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;


class EditGrade extends Component
{

    public $name = '';
    public $grade_id = '';

    public function mount($id)
    {
        $grade = Grade::find($id);
        $this->grade_id = $grade->id;

        $this->fill([
            'name' => $grade->name,
        ]);
    }

    public function update()
    {
        $data =  $this->validate([
            'name' => 'required|string',
        ]);

        Grade::findOrFail($this->grade_id)->update($data);

        Toaster::success('Grade updated successfully');

        return redirect()->route('grade.index');

    }

    public function render()
    {
        return view('livewire.teacher.grades.edit-grade');
    }
}
