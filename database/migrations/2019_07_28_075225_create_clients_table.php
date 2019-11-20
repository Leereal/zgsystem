<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');            
            $table->string('title');
            $table->date('date_of_birth')->nullable(); 
            $table->mediumText('address')->nullable(); 
            $table->string('gender');
            $table->string('business_telephone')->nullable(); 
            $table->string('home_telephone')->nullable();            
            $table->string('id_number')->unique();
            $table->date('date_joined')->nullable();             
            $table->string('medical_aid_number')->unique();  
            $table->string('cellphone')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();  
            $table->integer('membership_status')->default(1);
            $table->integer('card_status')->default(1);
            $table->decimal('premium')->nullable();
            $table->decimal('total_premium')->nullable();                
            $table->integer('status')->default(1);
            $table->integer('period_status')->default(1);

            $table->string('bank')->nullable(); 
            $table->string('branch')->nullable(); 
            $table->string('branch_code')->nullable(); 
            $table->string('account_number')->nullable(); 
            $table->string('ecocash')->nullable(); 
            $table->string('telecash')->nullable(); 
            $table->string('netcash')->nullable(); 
            $table->string('cancer')->default('No');
            $table->string('renal_disease')->default('No');
            $table->string('psychiatric_conditions')->default('No');
            $table->string('cardio_vascular_problems')->default('No');
            $table->string('hypertension')->default('No');
            $table->string('epilepsy')->default('No');
            $table->string('diabetes')->default('No');
            $table->string('leprosy')->default('No');
            $table->string('asthma')->default('No');
            $table->text('other')->nullable();
            $table->text('doc_address')->nullable();

            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('group_id')->nullable();           
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
        Schema::dropIfExists('clients');
    }
}
