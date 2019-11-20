<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryServiceProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_service_provider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('service_provider_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_service_provider');
    }
}
