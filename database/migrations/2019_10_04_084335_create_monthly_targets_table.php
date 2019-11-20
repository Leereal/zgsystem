<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount');
            $table->unsignedBigInteger('branch_id');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
             $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_targets');
    }
}
