<?php

namespace App\Livewire\Teacher\Attendances;

use App\Enums\TwelveMonths;
use App\Exports\AttendanceExport;
use App\Mail\MonthlyAttendanceReport;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
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



    public function updated()
    {
        if ($this->year && $this->month && $this->selectedGrade && $this->selectedSubject) {
            $this->fetchStudent();
        }
    }

    protected $listeners = ['refreshAttendance' => 'fetchStudent'];

    public function updatedYear() { $this->fetchStudent(); }
    public function updatedMonth() { $this->fetchStudent(); }
    public function updatedSelectedGrade() { $this->fetchStudent(); }
    public function updatedSelectedSubject() { $this->fetchStudent(); }

    public function fetchStudent()
    {
        // Remove the if condition - let the validation happen in the query
        $this->students = Student::when($this->selectedGrade, function($query) {
                $query->where('grade_id', $this->selectedGrade);
            })
            ->get();

        // Only proceed if we have all required filters
        if ($this->year && $this->month && $this->selectedGrade && $this->selectedSubject) {
            foreach ($this->students as $student) {
                foreach (range(1, Carbon::create($this->year, $this->month)->daysInMonth) as $day) {
                    $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
                    $this->attendance[$student->id][$day] = Attendance::where('student_id', $student->id)
                        ->where('subject_id', $this->selectedSubject)
                        ->whereDate('date', $date)
                        ->value('status') ?? 'Present';
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


    public function exportToExcel()
    {
        return Excel::download(new AttendanceExport(
            $this->year,
            $this->month,
            $this->selectedGrade,
            $this->selectedSubject,
        ), 'attendance.xlsx');
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
