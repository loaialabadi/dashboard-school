<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{    use HasFactory;

 // app/Models/Student.php
protected $fillable = ['name', 'phone', 'teacher_id', 'parent_id'];


public function teacher()
{
    return $this->belongsTo(Teacher::class);
}

public function parent()
{
    return $this->belongsTo(ParentModel::class, 'parent_id');
}

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

}
