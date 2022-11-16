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
            /* General */
            
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('materials')->nullable();
            $table->text('color')->nullable();
            $table->text('pattern')->nullable();
            $table->boolean('in_index')->nullable()->default(false);
            $table->boolean('is_favorite')->nullable()->default(false);

            /* Price */
            $table->string('price')->nullable();

            /* Inventory Info */
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('stock')->nullable();

            /* Aditional Info */
            $table->string('size_chart_file')->nullable();            
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('lenght')->nullable();
            $table->string('weight')->nullable();
            $table->string('brand')->nullable();
            $table->enum('availability', ['in stock', 'out of stock', 'available for order', 'discontinued'])->default('in stock')->nullable();

            /* Category */
            $table->integer('category_id')->nullable()->unsigned();

            /* Aditional Info */
            $table->string('status')->nullable();
            
            /* Tags */
            $table->text('search_tags')->nullable();

            /* Imagen */ 
            $table->string('image')->nullable();
            
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
