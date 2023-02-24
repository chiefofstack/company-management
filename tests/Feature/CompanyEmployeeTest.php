<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyEmployeeTest extends TestCase
{
    public function an_employee_can_be_updated(){
        $company = app(CompanyFactory::class)->withTasks(1)->create();
    }
}
