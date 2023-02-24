<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            factory('App\User')->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password')
            ]);

            factory('App\User')->create([
                'name' => 'Admin2',
                'email' => 'admin2@admin2.com',
                'password' => bcrypt('password')
            ]);
        }

    }
}
