<?php

use Illuminate\Database\Seeder;
use App\MOP;

class MOPTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MOP::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
         $barclays = MOP::create([
        	'name'=>'Cash'    	        	
        ]); 

         $barclays = MOP::create([
            'name'=>'Bank'                  
        ]); 

         $barclays = MOP::create([
            'name'=>'Swip'                  
        ]);  

         $barclays = MOP::create([
            'name'=>'Ecocash'                  
        ]);    
        
    }
}
