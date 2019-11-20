<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('coverage')->nullable();
            $table->string('ahfoz_number')->unique();
            $table->string('contact_person')->nullable();  
            $table->mediumText('address')->nullable(); 
            $table->string('phone_number')->nullable();  
            $table->string('cell_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('service_providers');
    }
}
