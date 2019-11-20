<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivitiesTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Activity::class,50)->create();
    }
}
