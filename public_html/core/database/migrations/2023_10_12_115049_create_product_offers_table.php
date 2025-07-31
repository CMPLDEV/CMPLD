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
        Schema::create('product_offers', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('product_id');
          $table->string('name')->nullable();
          $table->string('content')->nullable();
          $table->text('link')->nullable();
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
      Schema::dropIfExists('product_offers');
      $table->dropForeign('product_offers_product_id_foreign');
      $table->dropIndex('product_offers_product_id_index');
      $table->dropColumn('product_id');
    }
};
