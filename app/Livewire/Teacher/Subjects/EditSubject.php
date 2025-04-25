<?php

namespace App\Livewire\Teacher\Subjects;

use App\Models\Grade;
use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditSubject extends Component
{
    public $name = '';
    public $grade_name = '';
    public $subject_id = '';

    public function mount($id)
    {
        $subject = Subject::find($id);
        $this->subject_id = $subject->id;

        $this->fill([
            'name' => $subject->name,
            'grade_name' => $subject->grade_name,
        ]);
    }

    public function update()
    {
        $data =  $this->validate([
            'name' => 'required|string',
            'grade_name' => 'required',
        ]);

        Subject::findorFail($this->subject_id)->update($data);

        Toaster::success('Subject Updated Successfully');

        return redirect()->route('subject.index');
    }

    public function render()
    {
        return view('livewire.teacher.subjects.edit-subject', [
            'grades' => Grade::all()
        ]);
    }
}
