<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependentClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependent_claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_provider_id');
            $table->decimal('amount');
            $table->string('description');            
            $table->string('mop');
            $table->string('receipt_number')->unique();
            $table->string('ref_number');
            $table->date('dop'); 
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('dependent_id'); 
            $table->string('ip_address');
            $table->unsignedBigInteger('branch_id');
            $table->integer('status')->default(1); 
            $table->timestamps(); 
            $table->softDeletes();

            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('dependent_id')->references('id')->on('dependents')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependent_claims');
    }
}
