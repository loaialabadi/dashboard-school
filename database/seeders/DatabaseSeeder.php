<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // استدعاء Seeder للأدوار
        $this->call(RoleSeeder::class);
$this->call(SubjectSeeder::class);
$this->call(TeacherSeeder::class);
$this->call(StudentSeeder::class);
$this->call(TeacherSeeder::class);
$this->call(SubjectSeeder::class);


        // إنشاء المستخدمين
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'), // تأكد من تغيير كلمة المرور
        ]);
        $admin->assignRole('admin'); // تعيين دور "admin"

        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => bcrypt('teacherpassword'), // تأكد من تغيير كلمة المرور
        ]);
        $teacher->assignRole('teacher'); // تعيين دور "teacher"

        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('studentpassword'), // تأكد من تغيير كلمة المرور
        ]);
        $student->assignRole('student'); // تعيين دور "student"

        $parent = User::create([
            'name' => 'Parent User',
            'email' => 'parent@example.com',
            'password' => bcrypt('parentpassword'), // تأكد من تغيير كلمة المرور
        ]);
        $parent->assignRole('parent'); // تعيين دور "parent"
    }
}
