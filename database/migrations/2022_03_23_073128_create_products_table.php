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
            $table->unsignedBigInteger('Cat_id')->foreign('Cat_id')->references('id')->on('categories');
            $table->unsignedBigInteger('subcategory_id')->foreign('subcategory_id')->references('id')->on('sub_categories');
            $table->string('name')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('offer_price',8,2)->nullable();
            $table->string('units')->nullable();
            $table->string('size')->nullable();
            $table->string('vat')->nullable();
            $table->string('vat_type')->nullable();
            $table->text('image')->nullable();
            $table->integer('remaining_stock')->nullable();
            $table->integer('low_stock')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');

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
