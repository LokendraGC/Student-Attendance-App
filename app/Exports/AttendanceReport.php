<?php

namespace App\Exports;

use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthlyAttendanceExport implements FromCollection, WithHeadings
{
    protected $startDate, $endDate, $year, $month;

    public function __construct($startDate, $endDate, $year, $month)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        $attendances = Attendance::with('student')
            ->whereBetween("date", [$this->startDate, $this->endDate])
            ->get()
            ->groupBy('student_id');

        $daysInMonth = Carbon::create($this->year, $this->month)->daysInMonth;
        $data = [];

        foreach ($attendances as $studentId => $records) {
            $student = $records->first()->student;
            $row = [
                'Student ID' => $studentId,
                'Student Name' => $student->first_name . ' ' . $student->last_name
            ];

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
                $record = $records->firstWhere('date', $date);
                $row["Day $day"] = $record ? ucfirst($record->status) : 'Absent'; // Changed default to Absent
            }

            $data[] = $row;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $headings = ['Student ID', 'Student Name'];
        $daysInMonth = Carbon::create($this->year, $this->month)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $headings[] = "Day $day";
        }

        return $headings;
    }
}
