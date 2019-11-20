<?php

use Illuminate\Database\Seeder;
use App\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Payment::class,80)->create();
    }
}
