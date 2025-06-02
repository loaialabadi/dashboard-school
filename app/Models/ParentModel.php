<?php

namespace App\Models;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ParentModel extends Model
{
    use HasFactory;
  // app/Models/ParentModel.php
protected $fillable = ['name', 'phone', 'password'];

public function students()
{
  
    return $this->hasMany(Student::class, 'parent_id');
}

}
