<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Client;

$factory->define(Client::class, function (Faker $faker) {
    
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'id_number' => rand(100000,9999999),
        'email' => $faker->unique()->safeEmail,  
        'date_joined'=> now()->subMinutes(55),    
        'medical_aid_number' => rand(100000,9999999), 
        'cellphone'=>$faker->phoneNumber,
        'membership_status'=>1,
        'card_status'=>1,
        'title'=>'Mr',
        'gender'=>'Male',
        'branch_id' => mt_rand(1,5), 
        'user_id' => mt_rand(1,5), 
        'plan_id' => mt_rand(1,8),
        'created_at'=>now()->subDays(rand(5,210))      

       ];
});
