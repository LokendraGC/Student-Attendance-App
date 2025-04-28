<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Subject;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AttendanceExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithEvents
{
    protected $year;
    protected $month;
    protected $grade_id;
    protected $subject_id;
    protected $grade;
    protected $subject;

    public function __construct($year, $month, $grade_id, $subject_id)
    {
        $this->year = $year;
        $this->month = $month;
        $this->grade_id = $grade_id;
        $this->subject_id = $subject_id;
        $this->grade = Grade::find($grade_id);
        $this->subject = Subject::find($subject_id);
    }

    public function collection()
    {
        $attendances = Attendance::whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->where('grade_id', $this->grade_id)
            ->where('subject_id', $this->subject_id)
            ->with('student')
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
                $row["Day $day"] = $record ? ucfirst($record->status) : 'Present';
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

    public function title(): string
    {
        return 'Attendance Report';
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->setCellValue('A1',
                    'STUDENT ATTENDANCE REPORT FOR ' .
                    Carbon::create($this->year, $this->month)->format('F Y') .
                    ' - ' . $this->grade->name .
                    ' - ' . $this->subject->name
                );

                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle('A3:E3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFD9D9D9'],
                    ],
                ]);

                $event->sheet->getColumnDimension('A')->setWidth(25);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(25);
            },
        ];
    }
}
