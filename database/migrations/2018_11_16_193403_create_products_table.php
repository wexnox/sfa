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
            $table->timestamps();
//            $table->integer( 'category_id' )->unsigned();
            $table->string('imagePath');
            $table->string('title');
            $table->text('description');
            $table->integer('price');

//            $table->double( 'original_price' );
//            $table->double( 'discount_price' );
//            $table->tinyInteger( 'in_stock' )->default( 1 );
//            $table->tinyInteger( 'status' )->default( 0 );

//            $table->softDeletes();
            // TODO: Det må legges til flere ting
//            $table->foreign( 'category_id' )
//                ->references( 'id' )->on( 'categories' )
//                ->onDelete( 'cascade' )
//                ->onUpdate( 'cascade' );
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
