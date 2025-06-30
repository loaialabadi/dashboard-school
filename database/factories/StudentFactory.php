<?php

namespace Database\Factories;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->locale = 'ar_EG'; // تعيين اللغة العربية المصرية
   $academicStages = [
            'الصف الأول الابتدائي',
            'الصف الثاني الابتدائي',
            'الصف الثالث الابتدائي',
            'الصف الرابع الابتدائي',
            'الصف الخامس الابتدائي',
            'الصف السادس الابتدائي',
            'الصف الأول الإعدادي',
            'الصف الثاني الإعدادي',
            'الصف الثالث الإعدادي',
            'الصف الأول الثانوي',
            'الصف الثاني الثانوي',
            'الصف الثالث الثانوي',
        ];

        return [
            'name' => $this->faker->name, // اسم الطالب
            'phone' => $this->faker->phoneNumber, // رقم الهاتف
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id, // اختياري عشوائي للمدرس
            'academic_stage' => $this->faker->randomElement($academicStages),
        ];
    }
}
