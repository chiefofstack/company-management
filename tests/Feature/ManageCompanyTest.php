<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Company;

class CompanyTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Guest (Un-authenticated) user cannot dos:
     */

    /** @test */
    public function guests_cannot_manage_companies()
    {   
        // for debugging, when working on the test.
        //$this->withoutExceptionHandling(); 

        $company = factory('App\Company')->create();        

        $this->get('/companies')->assertRedirect('login');
        $this->get('/companies/create')->assertRedirect('login');
        $this->get($company->path().'/edit')->assertRedirect('login');
        $this->get($company->path())->assertRedirect('login');
        $this->delete($company->path())->assertRedirect('login');
        $this->post('/companies', $company->toArray())->assertRedirect('login');
    }

    /**
     * Authenticated user can dos:
     */

    /** @test */
    public function a_user_can_create_a_company()
    {   
        // for debugging, when working on the test.
        //$this->withoutExceptionHandling(); 

        // pseudo login
        $user = $this->signIn(); 
        
        // test create page exist
        $this->get('/companies/create')->assertStatus(200); 
        
        // create a new company object for the user
        $attributes = factory('App\Company')->raw(['created_by' => $user->id]); 
        
        // post the new company object
        $this->post('/companies', $attributes);
        
        // test if object was persisted to the db
        $this->assertDatabaseHas('companies', $attributes);

        // test to see if the inserted object show up in the company index 
        $this->get('/companies')->assertSee($attributes['name']);
    }

    /** @test */
    public function a_user_can_view_their_company()
    {   
        //$this->withoutExceptionHandling(); 
        
        // pseudo login
        $user = $this->signIn();

        // create a new company object for the user
        $company = factory('App\Company')->create(['created_by' => $user->id]);              

        // test to see if the object attributes can be seen on the show page
        $this->get($company->path()) 
            ->assertSee($company->name)
            ->assertSee($company->email)
            ->assertSee($company->logo)
            ->assertSee($company->website)
            ->assertSee($company->created_by);
    }

    /** @test */
    public function a_user_can_update_their_company()
    {   
        //$this->withoutExceptionHandling(); 
        
        // pseudo login
        $user = $this->signIn();

        // create a new company for the user
        $company = factory('App\Company')->create(['created_by' => $user->id]);    

        // test that the edit page exist
        $this->get($company->path().'/edit')->assertOk();

        // test if redirected to the show page after patching the object with the new attributes
        $this->patch($company->path(),  $attributes = ['name' => 'Changed Company Name', 'email' => 'changed@email.com', 'logo' => '14344logo.jpg', 'website' => 'www.changedwebsite.com'])
                ->assertRedirect($company->path());        

        // test if new attributes was persisted to the db
        $this->assertDatabaseHas('companies', $attributes);

        // dd(Company::all()); // for debugging
    }

    /** @test */
    public function a_user_can_delete_their_company()
    {   
        // $this->withoutExceptionHandling(); 
        
        // pseudo login
        $user = $this->signIn();

        // create a new company for the user
        $company = factory('App\Company')->create(['created_by' => $user->id]);    


        // test if redirected to the index page after deleting the object
        $this->delete($company->path())
                ->assertRedirect('/companies');        

        // test object is removed from the db
        $this->assertDatabaseMissing('companies', $company->only('id'));

        // dd(Company::all()); // for debugging
    }
    

    /**
     * Authenticated user - cannot dos:
     */

    /** @test */
    public function a_user_cannot_view_others_company()
    {
        //$this->withoutExceptionHandling(); 

        // pseudo login
        $user = $this->signIn();

        // create a new company 
        $company = factory('App\Company')->create();    

        // on get, test that the status is 403 unaunthorized 
        $this->get($company->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_cannot_update_others_company()
    {
        //$this->withoutExceptionHandling(); 

        // pseudo login
        $user = $this->signIn();

        // create a new company 
        $company = factory('App\Company')->create();    

        // on patch, test that the status is 403 unauthorized 
        $this->patch($company->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_cannot_delete_others_company()
    {
        //$this->withoutExceptionHandling(); 

        // pseudo login
        $user = $this->signIn();

        // create a new company 
        $company = factory('App\Company')->create();

          // on delete, test that the status is 403 unauthorized 
        $this->delete($company->path())->assertStatus(403);
    }


    /**
     * Input fields tests
     */

    /** @test */
    public function a_company_name_must_be_valid()
    {   // pseudo login
        $this->signIn(); 

        // create a new company with empty name
        $attributes = factory('App\Company')->raw(['name'=>'']); 
  
        // post the company object and expect errors on the form
        $this->post('/companies',[$attributes])->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_company_email_must_be_valid()
    {   $this->signIn(); 
        $attributes = factory('App\Company')->raw(['email'=>'']); 
        $this->post('/companies',[$attributes])->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_company_logo_must_be_valid()
    {   $this->signIn(); 
        $attributes = factory('App\Company')->raw(['logo'=>'']); 
        $this->post('/companies',[$attributes])->assertSessionHasErrors('logo');
    }

    /** @test */
    public function a_company_website_must_be_valid()
    {   $this->signIn();
        $attributes = factory('App\Company')->raw(['website'=>'']); 
        $this->post('/companies',[$attributes])->assertSessionHasErrors('website');
    }

}
