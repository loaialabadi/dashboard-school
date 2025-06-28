<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Appointment;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        $teachers = Teacher::all();
        return view('appointments.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        if ($request->has('group_name')) {
            // حالة إنشاء مجموعة بها مواعيد متعددة
            $request->validate([
                'teacher_id' => 'required|exists:teachers,id',
                'group_name' => 'required|string|max:255',
                'dates'      => 'required|array',
                'times'      => 'required|array',
            ]);

            $group = Group::create([
                'name'       => $request->group_name,
                'teacher_id' => $request->teacher_id,
            ]);

            $students = Student::where('teacher_id', $request->teacher_id)->get();

            foreach ($request->dates as $index => $date) {
                $time = $request->times[$index] ?? null;

                foreach ($students as $student) {
                    Appointment::create([
                        'teacher_id'       => $request->teacher_id,
                        'group_id'         => $group->id,
                        'student_id'       => $student->id,
                        'appointment_date' => $date,
                        'appointment_time' => $time,
                    ]);
                }
            }

            return redirect()->route('teachers.appointments', $request->teacher_id)
                             ->with('success', 'تم إضافة الحصص داخل المجموعة بنجاح');
        } else {
            // حالة إدخال حصة واحدة فقط بدون مجموعة
            $request->validate([
                'teacher_id'       => 'required|exists:teachers,id',
                'appointment_date' => 'required|date',
                'appointment_time' => 'required',
            ]);

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
                             ->with('success', 'تم إضافة الحصة لجميع الطلاب بنجاح');
        }
    }

    public function index($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        $appointments = Appointment::where('teacher_id', $teacherId)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('appointments.index', compact('teacher', 'appointments'));
    }

    public function createGroup($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        return view('appointments.create_group', compact('teacher'));
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'group_name' => 'required|string|max:255',
            'dates'      => 'required|array',
            'times'      => 'required|array',
        ]);

        $group = Group::create([
            'name'       => $request->group_name,
            'teacher_id' => $request->teacher_id,
        ]);

        $students = Student::where('teacher_id', $request->teacher_id)->get();

        foreach ($request->dates as $index => $date) {
            $time = $request->times[$index] ?? '08:00';

            foreach ($students as $student) {
                Appointment::create([
                    'teacher_id'       => $request->teacher_id,
                    'student_id'       => $student->id,
                    'group_id'         => $group->id,
                    'appointment_date' => $date,
                    'appointment_time' => $time,
                ]);
            }
        }

        return redirect()->route('teachers.appointments', $request->teacher_id)
                         ->with('success', 'تم إنشاء المجموعة وجدولة الحصص بنجاح.');
    }

    public function showAppointments($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        $appointments = $teacher->appointments()
            ->with('student')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('teachers.appointments', compact('teacher', 'appointments'));
    }
}
