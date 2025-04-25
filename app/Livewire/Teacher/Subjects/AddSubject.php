<?php

namespace App\Livewire\Teacher\Subjects;

use App\Models\Grade;
use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AddSubject extends Component
{
    public $name = '';
    public $grade_name = '';

    public function save()
    {
        $sub_data =  $this->validate([
            'name' => 'required|string',
            'grade_name' => 'required',
        ]);

        // dd($sub_data);

        Subject::create($sub_data);

        Toaster::success('Subject Added Successfully');

        return redirect()->route('subject.index');
    }

    public function render()
    {
        return view('livewire.teacher.subjects.add-subject', [
            'grades' => Grade::all(),
        ]);
    }
}
