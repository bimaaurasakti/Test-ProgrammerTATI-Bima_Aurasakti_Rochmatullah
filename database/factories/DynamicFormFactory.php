<?php

namespace Database\Factories;

use App\Models\DynamicForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DynamicForm>
 */
class DynamicFormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DynamicForm::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];
    }
}
