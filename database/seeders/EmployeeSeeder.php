<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Employee::factory(300)->create(['created_by' => 1]); //assign 300 employees to admin 1
        // Employee::factory(300)->create(['created_by' => 2]); //assign 300 employees to admin 1
    }
}
