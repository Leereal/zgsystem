<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->string('tag')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('client_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->unsignedBigInteger('m_o_p_id')->nullable();
            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->unsignedBigInteger('claim_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('role_user_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('password_reset_id')->nullable();            
            $table->unsignedBigInteger('bank_id')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
