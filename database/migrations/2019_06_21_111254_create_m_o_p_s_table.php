<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMOPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_o_p_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
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
        Schema::dropIfExists('m_o_p_s');
    }
}
