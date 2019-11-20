<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\ServiceProvider;
$factory->define(ServiceProvider::class, function (Faker $faker) {

	 return [
        'name' => $faker->firstName,
        'coverage' => $faker->state,        
        'contact_person' => $faker->name,
        'address' => $faker->address,           
        'email' => $faker->unique()->safeEmail,
        'cell_number'=>$faker->phoneNumber,
        'phone_number'=>$faker->phoneNumber,
        'ahfoz_number' => rand(100000,9999999)
       ];
   
});
