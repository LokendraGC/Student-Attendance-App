<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class DashboardOverview extends Component
{
    public $totlaStudents = '';
    public $totalTeachers = '';
    public $presentToday = '';
    public $absentToday = '';
    public $monthlyAttendanceRate = '';
    public $monthlyTrends = [];

    public function mount()
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        // Fetch Data
        $this->totlaStudents = User::role('student')->count();
        $this->totalTeachers = User::role('teacher')->count();
        $this->presentToday = Attendance::whereDate('date', $today)->where('status', 'present')->count();
        $this->absentToday = Attendance::whereDate('date', $today)->where('status', 'absent')->count();

        $totalClasses = Attendance::whereBetween('date', [$monthStart, $monthEnd])->count();
        $presentClass = Attendance::whereBetween('date', [$monthStart, $monthEnd])->where('status', 'present')->count();

        $this->monthlyAttendanceRate = $totalClasses > 0 ?  round(($presentClass / $totalClasses) * 100, 2) : 0;

        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $date = Carbon::createFromDate(Carbon::now()->year,  Carbon::now()->month, $i);

            $this->monthlyTrends[] = [
                'day' => $i,
                'count' => Attendance::whereDate('date', $date)->where('status', 'present')->count(),
            ];
        }
    }

    public function render()
    {
        return view('livewire.dashboard-overview');
    }
}
