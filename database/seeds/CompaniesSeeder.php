<?php

use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Company', 70)->create(['created_by' => 1]); //assign 70 companies to admin@admin.com
        factory('App\Company', 370)->create();
    }
}
