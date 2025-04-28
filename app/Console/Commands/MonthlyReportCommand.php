<?php

namespace App\Console\Commands;

use App\Mail\MonthlyAttendanceReport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class MonthlyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:send-report{ $type }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Monthly Attendance Via Email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $today = Carbon::today();

        if ($type == 'monthly') {
            $startDate  = $today->copy()->startOfMonth();
            $endDate = $today->copy()->endOfMonth();
        } else {
            $this->error('Invalid Type of error');
        }

        $fileName = "attendance_report_{{ $type }}";
        $filePath = "attendance_reports/{{ $fileName }}";

        Excel::store(new MonthlyAttendanceReport($startDate, $endDate), $filePath, 'public');

        Mail::to('gclokendra10@gmail.com')->send(new MonthlyAttendanceReport($type, $fileName));

        $this->info("{ $type } attendance report has been sent successfully");
    }
}
