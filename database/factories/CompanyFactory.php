<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use Faker\Generator as Faker;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // make folders 
        if (!file_exists(storage_path('app/public/uploaded/logos'))) {
            mkdir(storage_path('app/public/uploaded/logos'), 0755, true);
        }

        $companyName = $this->faker->company();

        return [
            'name' => $companyName,
            'email' => $this->faker->unique()->companyEmail(),
            'logo' => $this->faker->image(storage_path('app/public/uploaded/logos'), 100, 100, null, false, true, $companyName),
            'website' => 'http://'.$this->faker->domainName(),
            'created_by' => function() {
                return User::factory()->create()->id;
            }
        ];
    }
}
