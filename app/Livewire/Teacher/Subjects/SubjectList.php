<?php

namespace App\Livewire\Teacher\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SubjectList extends Component
{
    public $confirmingDelete = null;

    public function confirmDelete()
    {
        if ($this->confirmingDelete) {
            Subject::findOrFail($this->confirmingDelete)->delete();
            $this->confirmingDelete = null;

            Toaster::success("Subject deleted successfully");
            return redirect()->route("subject.index");
        }
    }

    public function render()
    {
        return view(
            'livewire.teacher.subjects.subject-list',
            [
                'subjects' => Subject::all()
            ]
        );
    }
}
