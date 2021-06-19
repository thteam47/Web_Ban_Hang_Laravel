<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('p_id');
            $table->string('p_name')->nullable();
            $table->string('p_slug')->index();
            $table->string('p_warranty');
            $table->string('p_accessories');
            $table->string('p_condition');
            $table->integer('p_price')->default(0);
            $table->string('p_promotion');
            $table->tinyInteger('p_status')->default(1);
            $table->integer('p_view')->default(0);
            $table->tinyInteger('p_active')->default(1)->index();
            $table->tinyInteger('p_hot')->default(0);
            $table->text('p_description')->nullable();
            $table->string('p_image')->nullable();
            $table->integer('prod_cate')->unsigned();
            $table->foreign('prod_cate')->references('c_id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
