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
            $table->id();
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug', 255)->unique();
            $table->integer('price')->default(0);
            $table->integer('review')->default(0);
            $table->integer('sell')->default(0);
            $table->integer('product_count')->default(0);
            $table->string('image')->nullable();
            $table->string('guaranty')->nullable();
            $table->string('discount')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_special')->default(false);
            $table->timestamp('special_expiration')->useCurrent();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate();

            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnUpdate();

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
