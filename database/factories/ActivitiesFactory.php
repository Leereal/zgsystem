<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Activity;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' =>$faker->realText(350),
        'tag' => $faker->word(),           
        'client_id' =>array_random([mt_rand(1,20), null]),
        'branch_id' => array_random([mt_rand(1,5), null]),
        'user_id' => array_random([mt_rand(1,10), null]),
        'plan_id' => array_random([mt_rand(1,5), null]),      
        'service_provider_id' => array_random([mt_rand(1,10), null]),
        'm_o_p_id' => array_random([mt_rand(1,4), null]),
        'claim_id' => array_random([mt_rand(1,10), null]),
        'payment_id' => array_random([mt_rand(1,50), null]),
        'role_user_id' => array_random([mt_rand(1,4), null]),
        'role_id' => array_random([mt_rand(1,5), null]),
        'password_reset_id' => array_random([mt_rand(1,4), null]),
        'bank_id' => array_random([mt_rand(1,4), null]),    

        'created_at'=>now()->subDays(rand(5,210)),

    ];
});

