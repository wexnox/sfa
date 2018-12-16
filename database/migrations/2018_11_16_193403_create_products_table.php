<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->string('imagePath');
            $table->text('description');
            $table->integer('price');
            $table->integer('original_price')->unsigned();
            $table->integer('discount_price')->unsigned();
            $table->tinyInteger('in_stock')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign( 'category_id' )
                ->references( 'id' )->on( 'categories' )
                ->onDelete( 'cascade' )
                ->onUpdate( 'cascade' );
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
