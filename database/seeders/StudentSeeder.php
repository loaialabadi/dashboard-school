<?php

namespace Database\Seeders;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

use App\Models\ParentModel;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            for ($i = 0; $i < 5; $i++) {
                $parent = ParentModel::factory()->create();

                Student::factory()->create([
                    'teacher_id' => $teacher->id,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}

