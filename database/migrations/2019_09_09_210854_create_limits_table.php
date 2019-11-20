<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_medical_aid_number');            
            $table->decimal('global_limit')->nullable();
            $table->decimal('hospitalization')->nullable();
            $table->decimal('ward_admission')->nullable();            
            $table->decimal('drugs')->nullable();
            $table->decimal('dental')->nullable();
            $table->decimal('optical')->nullable();
            $table->decimal('oncology')->nullable();
            $table->decimal('dialysis')->nullable();            
            $table->decimal('pathology')->nullable();
            $table->decimal('radiology')->nullable();
            $table->decimal('maternity')->nullable();
            $table->decimal('prosthesis')->nullable();
            $table->decimal('family_planning')->nullable();
            $table->decimal('physiotherapy')->nullable();
            $table->decimal('glucometer')->nullable();
            $table->decimal('funeral_grant')->nullable();                           
            $table->unsignedBigInteger('plan_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plan_id')->references('id')->on('plans');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('limits');
    }
}
