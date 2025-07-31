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
        Schema::create('tickets', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('product_id')->index();
          $table->string('product_name')->nullable();
          $table->string('subject')->nullable();
          $table->string('content')->nullable();
          $table->enum('status',['open','closed','resolved'])->default('open');
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
      Schema::dropIfExists('tickets');
    }
};
