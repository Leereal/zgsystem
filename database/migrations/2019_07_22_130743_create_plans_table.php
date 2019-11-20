<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->decimal('premium')->nullable();
            $table->decimal('dependent_premium')->nullable();
            $table->decimal('corporate_premium')->nullable();
            $table->decimal('corporate_dependent_premium')->nullable();
            $table->string('pre')->unique();
            $table->integer('last_number')->default(0);
            $table->integer('dependent_last_number')->default(0);
            $table->decimal('global_limit')->nullable();
            $table->decimal('hospitalization')->nullable();
            $table->decimal('ward_admission')->nullable();
            $table->decimal('gp_consultations')->nullable();
            $table->decimal('specialists_consultations')->nullable();
            $table->decimal('drugs')->nullable();
            $table->decimal('dental')->nullable();
            $table->decimal('optical')->nullable();
            $table->decimal('oncology')->nullable();
            $table->decimal('dialysis')->nullable();
            $table->decimal('ambulances')->nullable();
            $table->decimal('pathology')->nullable();
            $table->decimal('radiology')->nullable();
            $table->decimal('maternity')->nullable();
            $table->decimal('prosthesis')->nullable();
            $table->decimal('family_planning')->nullable();
            $table->decimal('physiotherapy')->nullable();
            $table->decimal('glucometer')->nullable();
            $table->decimal('funeral_grant')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
