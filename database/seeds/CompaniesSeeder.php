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
        factory('App\Company', 80)->create(['created_by' => 1]); //assign 80 companies to admin@admin.com
        factory('App\Company', 80)->create(['created_by' => 2]); //assign 80 companies to admin2@admin2.com
    }
}
