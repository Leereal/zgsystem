<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->date('date_of_birth')->nullable();
            $table->string('gender');
            $table->string('id_number')->unique();
            $table->date('date_joined')->nullable();             
            $table->string('medical_aid_number')->unique();
            $table->string('membership_status')->default(1);
            $table->string('card_status')->default(1);
            $table->decimal('premium');            
            $table->integer('status')->default(1);
            $table->integer('period_status')->default(1);
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('client_id');           
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
        Schema::dropIfExists('dependents');
    }
}
