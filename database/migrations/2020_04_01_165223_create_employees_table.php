<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('father_name');
            $table->boolean('status')->default(false);
            $table->string('image');

            $table->string('cnic');
            $table->date('dob');
            $table->date('joining_date');

            $table->integer('staff_id')->unsigned();
            $table->integer('designation_id')->unsigned();
            $table->integer('salary')->unsigned();
         
            $table->string('email');
            $table->string('phone');
            $table->string('phone_optional')->nullable();

            $table->longText('address');
            $table->longText('remarks')->nullable();
            $table->string('city');
            $table->string('gender')->default('unknown');
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
        Schema::dropIfExists('employees');
    }
}
