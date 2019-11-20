<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('caption');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('service_provider_id')->nullable();  
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('service_provider_id')->references('id')->on('service_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
