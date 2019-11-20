<?php

use Illuminate\Database\Seeder;
use App\ServiceProvider;

class ServiceProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ServiceProvider::class,20)->create();   
     }
}
