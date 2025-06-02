<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Subject;  // تأكد من استيراد Subject من المسار الصحيح
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تعطيل القيود الأجنبية مؤقتًا
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // حذف البيانات من جدول الأدوار
        Role::truncate();

        // إضافة الأدوار من جديد
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'student']);
                Role::create(['name' => 'teacher']); // هنا يتم إضافة دور "teacher"
Role::create(['name' => 'parent']);
        Role::create(['name' => 'user']);

        // تمكين القيود الأجنبية مرة أخرى
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    }

