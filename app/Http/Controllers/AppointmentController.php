<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create(Teacher $teacher)
    {
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addMonths(6);

        return view('appointments.create', compact('teacher', 'startDate', 'endDate'));
    }

    public function store(Request $request, Teacher $teacher)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addMonths(6)->toDateString(),
            'time' => 'required',
        ]);

        $teacher->appointments()->create([
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('appointments.index', $teacher->id)->with('success', 'تم إضافة الموعد بنجاح');
    }

public function index(Teacher $teacher)
{
    $students = $teacher->students;

    $appointments = Appointment::whereIn('student_id', $students->pluck('id'))
        ->orderBy('appointment_date')
        ->orderBy('appointment_time')
        ->get();

    return view('appointments.index', [
        'appointments' => $appointments,
        'students' => $students,
        'teacher' => $teacher,
    ]);
}

}
