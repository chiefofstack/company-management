<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_company(){

        $filepath = storage_path('app/public/logos');
        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'logo' => $this->faker->image($filepath, 400, 300), 
            'website' => $this->faker->url
        ];

        $this->post('/companies', $attributes);
        $this->assertDatabaseHas('companies', $attributes);
    }
}
