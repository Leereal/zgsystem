<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        Role::create(['name'=>'Administrator']);        
        Role::create(['name'=>'Marketing Consultant']);
        Role::create(['name'=>'Marketing Officer']);        
        Role::create(['name'=>'Claims Officer']);
        Role::create(['name'=>'Team Leader']);
        Role::create(['name'=>'Principal Officer']);
        Role::create(['name'=>'Chairman']);
        //Role::create(['name'=>'Service Provider']);
        //Role::create(['name'=>'Client']);
        Role::create(['name'=>'Brand Ambassador']);
        Role::create(['name'=>'System Admin']);
    }
}
