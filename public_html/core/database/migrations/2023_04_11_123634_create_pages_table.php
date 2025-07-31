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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('slug',200);
            $table->string('default_heading')->nullable();
            $table->string('location_heading')->nullable();
            $table->string('image',100)->nullable();
            $table->string('banner',100)->nullable();
            $table->longText('content')->nullable();
            $table->unsignedTinyInteger('for_header')->default(0);
            $table->unsignedTinyInteger('for_footer')->default(0);
            $table->unsignedInteger('order_by')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('m_content')->nullable();
            $table->string('m_title')->nullable();
            $table->string('m_description')->nullable();
            $table->string('m_keywords')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
