<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'company_id' => function() {
                return Company::select('id')->where('created_by','=',2)->inRandomOrder()->first();
            }
        ];
    }
}
