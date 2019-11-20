<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->decimal('amount');
            $table->string('description');
            $table->string('receipt_number')->unique();
            $table->string('ref_number'))->nullable()
            $table->text('month_paid_for')->nullable();
            $table->date('dop');
            $table->unsignedBigInteger('client_id'); 
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('m_o_p_id');
            $table->ipAddress('ip_address');            
            $table->integer('status')->default(1);            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');;
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('m_o_p_id')->references('id')->on('m_o_p_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
