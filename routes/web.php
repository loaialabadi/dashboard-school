<?php
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::resource('teachers', TeacherController::class);


Route::resource('students', StudentController::class);



Route::get('/attendance/class/{classId}', [AttendanceController::class, 'showClassAttendance'])->name('attendance.show');
Route::post('/attendance/class/{classId}', [AttendanceController::class, 'storeAttendance'])->name('attendance.store');



Route::resource('classes', ClassController::class)->only(['index', 'create', 'store']);



Route::get('/attendance/student/{studentId}/monthly-summary', [AttendanceController::class, 'studentMonthlySummary'])->name('attendance.monthly_summary');

Route::resource('parents', \App\Http\Controllers\ParentController::class);

Route::get('/teacher-dashboard/{id}', [\App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teachers.dashboard');


Route::get('/attendance/student/{studentId}/monthly-summary', [AttendanceController::class, 'studentMonthlySummary'])->name('attendance.monthly_summary');



Route::prefix('teachers/{teacher}')->group(function() {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index'); // عرض المواعيد
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create'); // نموذج إضافة موعد
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store'); // حفظ موعد جديد
});




Route::get('appointments/{appointment}/attendance', [AttendanceController::class, 'markAttendanceForm'])
    ->name('attendance.mark');

Route::post('appointments/{appointment}/attendance', [AttendanceController::class, 'saveAttendance'])
    ->name('attendance.save');




Route::prefix('appointments')->group(function () {
    Route::get('/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/store', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/{teacherId}', [AppointmentController::class, 'index'])->name('appointments.index');
});



Route::get('/teachers/{teacher}/appointments', [TeacherController::class, 'showAppointments'])->name('teachers.appointments');
// Route::get('/teachers/{teacher}/appointments', [AppointmentController::class, 'index'])->name('teachers.appointments');


Route::get('/teachers/{teacher}/showstudents', [TeacherController::class, 'showStudents'])->name('teachers.showstudents');

require __DIR__.'/auth.php';
require __DIR__.'/api.php';

