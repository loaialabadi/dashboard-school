<?php
namespace App\Models;
use App\Notifications\AppointmentScheduled;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;



class Appointment extends Model
{
protected $casts = [
    'scheduled_at' => 'datetime',
];

    protected $fillable = ['teacher_id', 'student_id', 'appointment_date', 'appointment_time'];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function group()
{
    return $this->belongsTo(Group::class);
}

}
