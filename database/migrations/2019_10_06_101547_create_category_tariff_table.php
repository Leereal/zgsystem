<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTariffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_tariff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('tariff_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_tariff');
    }
}
