<?php

use Illuminate\Database\Seeder;
Use App\Branch;
class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Branch::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        

        $gweru = Branch::create([
        	'branch_name'=>'Head Office',
        	'branch_email'=>'enquiries@zimgeneral.co.zw',
        	'branch_phone'=>'+263 54 222 3416',
        	'branch_address'=>'Suite No 5 , 1st Floor Moonlight Building 5th Street,Gweru , Zimbabwe',        	
        ]);
        $mutare = Branch::create([
        	'branch_name'=>'Mutare',
        	'branch_email'=>'enquiries@zimgeneral.co.zw',
        	'branch_phone'=>'024 2565656',
        	'branch_address'=>'12 Kaguvi Street',        	
        ]);
        $masvingo = Branch::create([
        	'branch_name'=>'Masvingo',
        	'branch_email'=>'enquiries@zimgeneral.co.zw',
        	'branch_phone'=>'0775 166 683',
        	'branch_address'=>'Cnr. Hughes Street & Simon Mazorodze , Zimre Centre,4th Floor Left Wing ',        	
        ]);
        $harare = Branch::create([
        	'branch_name'=>'Harare',
        	'branch_email'=>'enquiries@zimgeneral.co.zw',
        	'branch_phone'=>'0242759981',
        	'branch_address'=>'7th Floor , West Wing, Karigamombe Centre
Union Avenue ',        	
        ]);

        $bulawayo = Branch::create([
        	'branch_name'=>'Bulawayo',
        	'branch_email'=>'enquiries@zimgeneral.co.zw',
        	'branch_phone'=>'0773 086 971',
        	'branch_address'=>'3rd Floor Masiya Building, Office 8 & 9 Corner Fort Street & 9th Avenue',        	
        ]);
        
    }
}
