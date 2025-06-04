<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Student; // افتراض وجود موديل Student
class AppointmentController extends Controller
{
   
public function create()
{
    $teachers = Teacher::all();
    return view('appointments.create', compact('teachers'));
}

    // تخزين الحصة الجديدة
public function store(Request $request)
{
    $request->validate([
        'teacher_id'       => 'required|exists:teachers,id',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required',
    ]);

    // جلب جميع طلاب المعلم المحدد
    $students = Student::where('teacher_id', $request->teacher_id)->get();

    foreach ($students as $student) {
        Appointment::create([
            'teacher_id'       => $request->teacher_id,
            'student_id'       => $student->id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);
    }

return redirect()->route('teachers.appointments', $request->teacher_id)
                 ->with('success', 'تم إضافة الحصة لجميع طلاب المعلم بنجاح');

}

public function index($teacherId)
{
    // جلب بيانات المعلم
    $teacher = Teacher::findOrFail($teacherId);

    // جلب مواعيد المعلم المرتبة
    $appointments = Appointment::where('teacher_id', $teacherId)
                    ->orderBy('appointment_date')
                    ->orderBy('appointment_time')
                    ->get();

    // إرسال البيانات إلى الفيو
    return view('appointments.index', compact('teacher', 'appointments'));
}





public function showAppointments($teacherId)
{
    $teacher = Teacher::findOrFail($teacherId);
    $appointments = $teacher->appointments()->with('student')->orderBy('appointment_date')->orderBy('appointment_time')->get();

    return view('teachers.appointments', compact('teacher', 'appointments'));
}


}
