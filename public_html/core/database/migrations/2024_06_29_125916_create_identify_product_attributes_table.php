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
      Schema::create('identify_product_attributes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('identify_product_id')->index();
        $table->string('key',150);
        $table->string('value');
        $table->timestamps();
        $table->foreign('identify_product_id')->references('id')->on('identify_products')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('identify_product_attributes');
      $table->dropForeign('identify_product_attributes_identify_product_id_foreign');
      $table->dropIndex('identify_product_id_index');
      $table->dropColumn('identify_product_id');
    }
};
