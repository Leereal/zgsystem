<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Client;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,        
        'id_number' => mt_rand(10),        
        'medical_aid_number' => mt_rand(10),
        'mobile_number'=>$faker->phoneNumber,
        'membership_status'=>1,
        'card_status'=>1,
        'branch_id' => mt_rand(1,5),    ];
});
