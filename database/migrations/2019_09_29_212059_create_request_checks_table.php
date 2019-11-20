<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('service_provider_id');  
            $table->unsignedBigInteger('dependent_id')->nullable();
            $table->string('medical_aid_number');
            $table->unsignedBigInteger('branch_id');
            $table->integer('status')->default(1);
            $table->integer('approved')->default(2);
            $table->string('pre_code')->nullable();              
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');           
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('dependent_id')->references('id')->on('dependents')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_checks');
    }
}
