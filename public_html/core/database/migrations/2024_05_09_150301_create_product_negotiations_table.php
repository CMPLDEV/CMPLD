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
     Schema::create('product_negotiations', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('product_id')->index();
      $table->string('email')->nullable();
      $table->string('mobile',15)->nullable();
      $table->string('product_found_on')->nullable();
      $table->unsignedBigInteger('price');
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
      Schema::dropIfExists('product_negotiations');
    }
};
