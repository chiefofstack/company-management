<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {

    // make folders 
    if (!file_exists(storage_path('app/public/uploaded/logos'))) {
        mkdir(storage_path('app/public/uploaded/logos'), 0755, true);
    }

    $companyName = $faker->company();

    return [
        'name' => $companyName,
        'email' => $faker->unique()->companyEmail(),
        'logo' => $faker->image(storage_path('app/public/uploaded/logos'), 100, 100, null, false, true, $companyName),
        'website' => 'http://'.$faker->domainName(),
    ];
});
