<?php

use Illuminate\Database\Seeder;
use App\Bank;
class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Bank::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        

        $barclays = Bank::create([
        	'name'=>'Barclays',
        	'account_number'=>'5353535535',        	        	
        ]);

        $cabs = Bank::create([
        	'name'=>'Cabs',
        	'account_number'=>'39938477402',        	        	
        ]);

        $fbc = Bank::create([
        	'name'=>'FBC',
        	'account_number'=>'65648364773',        	        	
        ]);

        $cbz = Bank::create([
        	'name'=>'CBZ',
        	'account_number'=>'100910383833333',        	        	
        ]);       
        
    }
}
