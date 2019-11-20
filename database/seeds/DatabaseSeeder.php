<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       $this->call(RolesTableSeeder::class);
       $this->call(BranchesTableSeeder::class);
       $this->call(MOPTableSeeder::class); 

       //  //Fake but needs adjustment          
       $this->call(BanksTableSeeder::class);            

       //  //Fake Data
       $this->call(UsersTableSeeder::class);
       $this->call(ClientsTableSeeder::class);
       $this->call(ServiceProviderTableSeeder::class);
       $this->call(PlansTableSeeder::class); 
       $this->call(PaymentsTableSeeder::class); 
       $this->call(ActivitiesTableSeeeder::class);     

       
    }
}
