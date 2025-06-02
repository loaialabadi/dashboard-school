<?php

namespace Database\Factories;
use App\Models\ParentModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ParentModelFactory extends Factory
{
        protected $model = ParentModel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
                        'password' => Hash::make('12345678'), // أو bcrypt('12345678')

            // أضف أي أعمدة أخرى موجودة في جدول parent_models
        ];
    }
}
