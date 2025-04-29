<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Auth\RegisterTeacher;
use App\Livewire\Roles\AddRole;
use App\Livewire\Roles\EditRole;
use App\Livewire\Roles\RoleIndex;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Teacher\Attendances\AttendancePage;
use App\Livewire\Teacher\Grades\AddGrade;
use App\Livewire\Teacher\Grades\EditGrade;
use App\Livewire\Teacher\Grades\GradeList;
use App\Livewire\Teacher\Students\AddStudent;
use App\Livewire\Teacher\Students\EditStudent;
use App\Livewire\Teacher\Students\StudentList;
use App\Livewire\Teacher\Subjects\AddSubject;
use App\Livewire\Teacher\Subjects\EditSubject;
use App\Livewire\Teacher\Subjects\SubjectList;
use App\Livewire\TeacherDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified', 'teacher'])
//     ->name('teacher.dashboard');



Route::middleware(['auth'])->group(function () {

    // admin
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    });

    // teacher
    Route::middleware(['auth', 'role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', TeacherDashboard::class)->name('teacher.dashboard');
    });

    // student
    Route::middleware(['auth', 'role:student'])->group(function () {
        Route::view('dashboard', 'dashboard')->name('student.dashboard');
    });

    Route::redirect('settings', 'settings/profile');

    Route::middleware(['auth'])->group(function () {
        // students
        Route::get('/student-list', StudentList::class)->name('student.index');
        Route::get('create/student', AddStudent::class)->name('student.create');
        Route::get('edit/student/{id}', EditStudent::class)->name('student.edit');
    });

    // grades
    Route::get('/grade-list', GradeList::class)->name('grade.index');
    Route::get('/grade/create', AddGrade::class)->name('grade.create');
    Route::get('edit/grade/{id}', EditGrade::class)->name('grade.edit');

    // subject
    Route::get('/subject-list', SubjectList::class)->name('subject.index');
    Route::get('/subject/create', AddSubject::class)->name('subject.create');
    Route::get('edit/subject/{id}', EditSubject::class)->name('subject.edit');

    // Attendances
    Route::get('/attendance', AttendancePage::class)->name('attendance.page');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Roles
    Route::get('/roles-list', RoleIndex::class)->name('role.index');
    Route::get('/role/create', AddRole::class)->name('role.create');
    Route::get('/edit/role/{id}', EditRole::class)->name('role.edit');
});

require __DIR__ . '/auth.php';
