<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Appointment;

class GroupController extends Controller
{
    public function createGroup($teacherId)
{
    $teacher = Teacher::findOrFail($teacherId);
    // جلب الطلاب التابعين للمعلم
    $students = Student::where('teacher_id', $teacherId)->get();

    return view('groups.create', compact('teacher', 'students'));
}
public function storeGroup(Request $request)
{
 $request->validate([
    'teacher_id' => 'required|exists:teachers,id',
    'group_name' => 'required|string|max:255',
    'student_ids' => 'required|array|min:1',
    'student_ids.*' => 'exists:students,id',
    'dates' => 'required|array|min:1',
    'dates.*' => 'date',
    'times' => 'required|array|min:1',
    'times.*' => 'date_format:H:i',
]);


    $group = Group::create([
        'name'       => $request->group_name,
        'teacher_id' => $request->teacher_id,
    ]);

    // ربط الطلاب بالمجموعة
    $group->students()->sync($request->student_ids);

    // جدول المواعيد
    foreach ($request->dates as $index => $date) {
        $time = $request->times[$index] ?? '08:00';

        foreach ($request->student_ids as $studentId) {
            Appointment::create([
                'teacher_id'       => $request->teacher_id,
                'student_id'       => $studentId,
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

    public function showGroups($teacherId)
{
    $teacher = Teacher::findOrFail($teacherId);

    // جلب المجموعات مع الطلاب المرتبطين بكل مجموعة
    $groups = $teacher->groups()->with('students')->get();

    return view('groups.show-groups', compact('teacher', 'groups'));
}

}
