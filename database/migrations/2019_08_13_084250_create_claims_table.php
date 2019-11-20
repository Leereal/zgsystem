<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->decimal('total_amount');            
            $table->string('receipt_number')->nullable();
            $table->string('pre_authorization_code')->nullable();          
            $table->string('claim_number');
            $table->string('diagnosis');
            $table->string('medical_aid_number');
            $table->string('accident')->nullable();
            $table->string('name_of_referring_practitioner')->nullable();
            $table->string('name_of_anaesthesist')->nullable();
            $table->string('name_of_surgical_assistant')->nullable();
            $table->string('referring_practitioner_ahfoz_number')->nullable();
            $table->string('anaesthesist_ahfoz_number')->nullable();
            $table->string('surgical_assistant_ahfoz_number')->nullable();
            $table->date('dop')->nullable();
            $table->date('date_claim_closed');
            $table->ipAddress('ip_address');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('branch_id');            
            $table->unsignedBigInteger('m_o_p_id')->nullable();
            $table->integer('approved')->default(2);
            $table->integer('status')->default(1); 
            $table->timestamps(); 
            $table->softDeletes();

            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');            
            $table->foreign('m_o_p_id')->references('id')->on('m_o_p_s');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
