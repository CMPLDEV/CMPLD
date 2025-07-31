<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('image',100)->nullable();
            $table->string('banner',100)->nullable();
            $table->string('catalog',100)->nullable();
            $table->string('name',200)->nullable();
            $table->string('slug',200)->nullable();
            $table->text('content')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('order_by')->nullable();
            $table->unsignedTinyInteger('for_home')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
