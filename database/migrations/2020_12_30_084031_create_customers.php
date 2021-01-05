<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('CodeCustomer')->nullable();
            $table->string('name');
            $table->string('birthday');
            $table->string('phone');
            $table->string('address');
            $table->string('location')->nullable();
            $table->string('Type');
            $table->string('Owner');
            $table->string('Facebook')->nullable();
            $table->string('dukienthi')->nullable();
            $table->string('createdBy');
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('school')->nullable();
            $table->string('first')->nullable();
            $table->string('datefirst')->nullable();
            $table->string('second')->nullable();
            $table->string('datesecond')->nullable();
            $table->string('third')->nullable();
            $table->string('fourth')->nullable();
            $table->string('datethird')->nullable();
            $table->string('datefour')->nullable();
            $table->string('healthyMoney')->nullable();
            $table->string('dayhealth')->nullable();
            $table->string('totalMoney')->nullable();
            $table->string('statusExam')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
