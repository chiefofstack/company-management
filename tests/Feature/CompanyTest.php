<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_view_a_company(){
        
        $this->withoutExceptionHandling();

        $company = factory('App\Company')->create();

        $this->get('/companies/'.$company->id)
            ->assertSee($company->name)
            ->assertSee($company->email)
            ->assertSee($company->logo)
            ->assertSee($company->website)
    }

    /** @test */
    public function a_user_can_create_a_company(){
        
        $this->withoutExceptionHandling();

        // set attributes
        $filepath = storage_path('app/public/uploaded/logos');
        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'logo' => $this->faker->image($filepath, 400, 300), 
            'website' => $this->faker->url
        ];
        // make a post request to the url with the attributes
        $this->post('/companies', $attributes)->assertRedirect('/companies');

        // expect to be inserted to the companies table
        $this->assertDatabaseHas('companies', $attributes);

        // expect to see inserted attributes
        $this->get('/companies')->assertSee($attributes['name']);
    }

    /** @test */
    public function a_company_name_must_be_valid()
    {   
        $attributes = factory('App\Company')->raw(['name'=>'']); //return an array
        $this->post('/companies',[$attributes])->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_company_email_must_be_valid()
    {   
        $attributes = factory('App\Company')->raw(['email'=>'']); 
        $this->post('/companies',[])->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_company_logo_must_be_valid()
    {   
        $attributes = factory('App\Company')->raw(['logo'=>'']); 
        $this->post('/companies',[])->assertSessionHasErrors('logo');
    }

    /** @test */
    public function a_company_website_must_be_valid()
    {   
        $attributes = factory('App\Company')->raw(['website'=>'']); 
        $this->post('/companies',[])->assertSessionHasErrors('website');
    }
}
