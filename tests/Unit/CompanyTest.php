<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;


//unit tests for something a model can do
class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path(){
        $company = factory('App\Company')->create();
        $this->assertEquals('/companies/'. $company->id, $company->path());

    }
}
