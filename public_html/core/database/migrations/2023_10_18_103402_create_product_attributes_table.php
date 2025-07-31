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
      Schema::create('product_attributes', function (Blueprint $table) {
       $table->id();
       $table->unsignedBigInteger('product_id')->index();
       $table->string('key')->nullable();
       $table->string('value')->nullable();
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
      Schema::dropIfExists('product_attributes');
      $table->dropForeign('product_attributes_product_id_foreign');
      $table->dropIndex('product_attributes_product_id_index');
      $table->dropColumn('product_id');
    }
};
