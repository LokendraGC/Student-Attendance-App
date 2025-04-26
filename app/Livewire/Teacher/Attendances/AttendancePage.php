<?php

namespace App\Livewire\Teacher\Attendances;

use App\Enums\TwelveMonths;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AttendancePage extends Component
{

    public $selectedGrade = null;
    public $filteredSubjects = [];
    public $selectedSubject = null;
    public $year = null;
    public $month = null;
    public $students = null;
    public $attendance = null;
    public $status = null;
    public $student_id = null;

    public function updated($propertyName)
    {
        if ($this->year && $this->month && $this->selectedGrade && $this->selectedSubject) {
            $this->fetchStudent();
        }
    }


    public function fetchStudent()
    {
        if ($this->year &&  $this->month && $this->selectedGrade && $this->selectedSubject) {
            $this->students = Student::where('grade_id', $this->selectedGrade)
                ->get();
            // generate day in a month
            foreach ($this->students as $student) {
                foreach (range(1, Carbon::create($this->year, $this->month)->daysInMonth) as $day) {
                    $date  = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
                    // fetching student status
                    $this->attendance[$student->id][$day] = Attendance::where('student_id', $student->id)->whereDate('date', $date)->value('status') ?? 'Present';
                }
            }
        }
    }



    public function updateAttendance($student_id, $day, $status, $silent = false)
    {
        try {
            $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
            $student = Student::find($student_id);
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $date
                ],
                [
                    'status' => $status,
                    'grade_id' => $this->selectedGrade,
                    'subject_id' => $this->selectedSubject,
                ]
            );

            $this->attendance[$student_id][$day] = $status;
            if (!$silent) {
                Toaster::success("Attendance for date $date and Student $student->first_name $student->last_name updated.");
            }
        } catch (\Exception $e) {
            Toaster::error("Error updating attendance: " . $e->getMessage());
        }
    }


    public function markAll($day, $status)
    {
        foreach ($this->students as $student) {
            $this->updateAttendance($student->id, $day, $status, true);
        }
        Toaster::success("All students marked as '$status' for day $day.");
    }


    public function render()
    {

        $this->fetchStudent();

        return view('livewire.teacher.attendances.attendance-page', [
            'twelvemonths' => TwelveMonths::cases(),
            'grades' => Grade::all(),
            'subjects' => ($grade = Grade::find($this->selectedGrade))
                ? Subject::where('grade_name', $grade->name)->get()
                : [],
            'daysInMonth' => Carbon::create($this->year, $this->month)->daysInMonth,
            'selected_month' => Carbon::create()->month((int) $this->month)->format('F')
        ]);
    }
}
