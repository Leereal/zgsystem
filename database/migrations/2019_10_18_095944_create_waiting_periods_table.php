<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitingPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiting_periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_medical_aid_number'); 
            $table->date('general_service_waiting_period')->nullable();
            $table->date('spectacles_waiting_period')->nullable();            
            $table->date('hospitalization_waiting_period')->nullable();
            $table->date('maternity_waiting_period')->nullable();  
            $table->date('dental_waiting_period')->nullable();
            $table->date('specialist_consultation_waiting_period')->nullable();
            $table->date('dentures_waiting_period')->nullable(); 
            $table->date('ct_scans_waiting_period')->nullable();
            $table->date('oncology_waiting_period')->nullable();
            $table->date('dialysis_waiting_period')->nullable(); 
            $table->date('prosthesis_waiting_period')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waiting_periods');
    }
}
