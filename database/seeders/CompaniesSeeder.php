<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;


class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(80)->create(['created_by' => 1]); //assign 80 companies to admin@admin.com
        Company::factory(80)->create(['created_by' => 2]); //assign 80 companies to admin2@admin2.com
    }
}
