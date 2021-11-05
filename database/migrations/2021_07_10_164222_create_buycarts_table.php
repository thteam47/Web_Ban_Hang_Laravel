<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuycartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buycarts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_buyer')->unsigned();
            $table->foreign('id_buyer')->references('id')->on('users')->onDelete('cascade');
            $table->text('infoBuyer');
            $table->text('infoProduct');
            // $table->integer('id_product')->unsigned();
            // $table->foreign('id_product')->references('p_id')->on('products')->onDelete('cascade');
            $table->bigInteger('total')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('buycarts');
    }
}
