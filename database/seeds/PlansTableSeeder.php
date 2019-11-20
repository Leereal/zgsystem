<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Plan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        Plan::create(['name'=>'General','pre'=>'ZGE1-','premium'=>30,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);        
        Plan::create(['name'=>'Silver','pre'=>'ZGS1-','premium'=>35,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Gold','pre'=>'ZGG1-','premium'=>40,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);        
        Plan::create(['name'=>'Platinum','pre'=>'ZGP1-','premium'=>45,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Executive Platinum Plus','pre'=>'ZGEP1-','premium'=>50,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Flexi 6 Gold','pre'=>'ZFG1-','premium'=>55,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Flexi 6 Platinum','pre'=>'ZFP1-','premium'=>60,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Footballers Shield Plan A','pre'=>'ZFA1-','premium'=>65,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Footballers Shield Plan B','pre'=>'ZFB1-','premium'=>70,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Senior Citizen','pre'=>'ZSC1-','premium'=>75,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);
        Plan::create(['name'=>'Senior Citizen Diamond','pre'=>'ZSD1-','premium'=>80,'dependent_premium'=>20,'global_limit'=>10000,'hospitalization'=>2000,'ward_admission'=>3000,'drugs'=>5000,'dental'=>7000,'optical'=>5000,'oncology'=>1000,'dialysis'=>2000,'pathology'=>4000,'radiology'=>3000,'maternity'=>5000,'prosthesis'=>6000,'family_planning'=>5000,'physiotherapy'=>3000,'glucometer'=>2000,'funeral_grant'=>10000]);              
    }
}
