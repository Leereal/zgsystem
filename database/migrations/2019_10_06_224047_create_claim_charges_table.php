<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount');
            $table->decimal('quantity');
            $table->string('mods');    
            //$table->string('description');
            $table->dateTime('year_month')->nullable();           
            $table->integer('days')->nullable();
            $table->unsignedBigInteger('tariff_id');
            $table->unsignedBigInteger('claim_id');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tariff_id')->references('id')->on('tariffs');
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_charges');
    }
}
