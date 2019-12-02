<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_code');
            $table->string('name');
            $table->integer('mobile');
            $table->string('photo')->default('defult.jpg');
            $table->integer('sale');
            $table->integer('quantity');
            $table->integer('rate');
            $table->integer('discount');
            $table->integer('total');
            $table->integer('payment');
            $table->integer('due');
            $table->longText('address');
            $table->longText('comment');
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
