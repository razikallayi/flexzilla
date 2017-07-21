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

            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('slug')->nullable();
            $table->text('brief')->nullable();
            $table->text('description')->nullable();
            $table->string('product_category_id')->nullable();
            $table->string('attributes')->nullable();
            $table->text('specifications')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->nullable();
            $table->integer('discount')->nullable();
            
            $table->text('name_ar')->nullable();
            $table->text('brief_ar')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('specifications_ar')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_selling')->default(false);
            $table->boolean('is_published')->default(false);
            $table->integer('listing_order')->nullable();

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
