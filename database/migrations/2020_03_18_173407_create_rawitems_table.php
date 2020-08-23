<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('catagory_id');
            $table->integer('vendor_id');
            $table->string('measuring_unit');
            $table->integer('reorder_level');
            $table->integer('reorder_qty');
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
        Schema::dropIfExists('rawitems');
    }
}
