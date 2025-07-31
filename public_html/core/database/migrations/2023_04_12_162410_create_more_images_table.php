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
        Schema::create('more_images', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('product_id');
          $table->string('image',100);
          $table->timestamps();
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('more_images');
        $table->dropForeign('more_images_product_id_foreign');
        $table->dropIndex('more_images_product_id_index');
        $table->dropColumn('product_id');
    }
};
