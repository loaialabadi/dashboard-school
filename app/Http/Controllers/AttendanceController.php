<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\AttendanceNotification;
class AttendanceController extends Controller
{
    public function showClassAttendance($classId)
    {
        $class = ClassModel::with('teacher', 'subject')->findOrFail($classId);
        // جلب كل طلاب المدرس أو طلاب مرتبطين بالحصة
        $students = Student::where('teacher_id', $class->teacher_id)->get();

        // جلب الحضور السابق إن وجد
        $attendanceRecords = Attendance::where('class_id', $classId)->get()->keyBy('student_id');

        return view('attendance.class_attendance', compact('class', 'students', 'attendanceRecords'));
    }

    public function storeAttendance(Request $request, $classId)
    {
        $class = ClassModel::findOrFail($classId);

        $data = $request->input('attendance', []); // array: student_id => status

        foreach ($data as $studentId => $status) {
            Attendance::updateOrCreate(
                ['class_id' => $classId, 'student_id' => $studentId],
                [
                    'status' => $status,
                    'attended_at' => $status == 'present' ? Carbon::now() : null,
                ]
            );

            // إرسال إشعار للولي
            $student = Student::find($studentId);
            if ($student && $student->parent && $status == 'present') {
                $student->parent->notify(new AttendanceNotification($student, $class));
            }
        }

        return redirect()->back()->with('success', 'تم تسجيل الحضور بنجاح');
    }

    
public function studentMonthlySummary(Request $request, $studentId)
{
    // تحقق من وجود الطالب
    $student = Student::findOrFail($studentId);

    // اجلب السنة والشهر من الريكوست أو اعطِهم قيم افتراضية
    $year = $request->input('year', date('Y'));
    $month = $request->input('month', date('m'));

    // بداية ونهاية الشهر
$startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->startOfDay();
$endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

    // الحصص المرتبطة بالطالب (عن طريق المعلم أو غيره حسب تصميمك)
    // لنفترض أن لكل حصة جدول attendance يربط بين class_id و student_id مع status حضور أو غياب
$attendances = Attendance::where('student_id', $studentId)
    ->whereBetween('attended_at', [$startDate, $endDate])
    ->get();


    $totalSessions = $attendances->count();
    $presentCount = $attendances->where('status', 'present')->count();
    $absentCount = $attendances->where('status', 'absent')->count();

    return view('attendance.monthly_summary', compact('student', 'year', 'month', 'totalSessions', 'presentCount', 'absentCount', 'attendances'));
}



}
