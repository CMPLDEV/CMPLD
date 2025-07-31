<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('category_ids')->nullable();
            $table->string('sku')->nullable();
            $table->string('image',100)->nullable();
            $table->string('banner',100)->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->text('short_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->unsignedTinyInteger('is_featured')->default(0);
            $table->unsignedTinyInteger('is_slide')->default(0);
            $table->unsignedBigInteger('mrp')->default(0);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('stock')->default(0);
            $table->unsignedInteger('order_by')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
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
};
