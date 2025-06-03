<?php
namespace App\Models;
use App\Notifications\AppointmentScheduled;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['teacher_id', 'student_id', 'appointment_date', 'appointment_time'];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    
public function store(Request $request, Teacher $teacher)
{
    $request->validate([
        'scheduled_at' => 'required|date|after:now',
        'note' => 'nullable|string',
    ]);

    Appointment::create([
        'teacher_id' => $teacher->id,
        'scheduled_at' => $request->scheduled_at,
        'note' => $request->note,
    ]);

    return redirect()->route('appointments.index', $teacher)->with('success', 'تم إضافة الموعد بنجاح.');
}

}

