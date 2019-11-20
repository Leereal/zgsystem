<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Payment;

$factory->define(Payment::class, function (Faker $faker) {
     return [
        'amount' => $faker->numberBetween($min = 10, $max = 900),
        'description' => "Payment",
        'receipt_number' => rand(100000,9999999),
        'ref_number' => $faker->unique()->safeEmail,  
        'dop'=> $faker->dateTimeBetween(1471870457,'now'),    
        'client_id' => mt_rand(1,20), 
        'ip_address'=>mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255),        
        'branch_id' => mt_rand(1,5), 
        'user_id' => mt_rand(1,5), 
        'plan_id' => mt_rand(1,5),      
        'm_o_p_id' => mt_rand(1,4),
        'created_at'=>now()->subDays(rand(5,210)) 
       ];
});
