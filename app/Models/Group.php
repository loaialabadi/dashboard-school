<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Group extends Model
{
    protected $fillable = ['name', 'teacher_id'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

