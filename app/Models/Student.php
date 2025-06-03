<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // استخدم Authenticatable للمصادقة
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['name', 'phone', 'password', 'teacher_id', 'parent_id'];

    protected $hidden = ['password'];

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
