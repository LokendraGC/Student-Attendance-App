<?php

namespace App\Livewire\Teacher\Attendances;

use App\Enums\TwelveMonths;
use App\Models\Grade;
use Livewire\Component;

class AttendancePage extends Component
{

    public function render()
    {
        return view('livewire.teacher.attendances.attendance-page', [
            'twelvemonths' => TwelveMonths::cases(),
             'grades' =>Grade::all(),
        ]);
    }
}
