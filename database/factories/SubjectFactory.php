<?php

namespace Database\Factories;
use App\Models\Subject;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           return [
'name' => $this->faker->randomElement([
    'عربي',
    'رياضيات',
    'إنجليزي',
    'فرنساوي',
    'كيمياء',
    'فيزياء',
    'أحياء',
]),
        ];
    }
}
