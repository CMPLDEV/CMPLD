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
      Schema::create('logs', function (Blueprint $table) {
       $table->id();
       $table->enum('action', ['ADD','UPDATE','DELETE']);
       $table->unsignedInteger('action_by_id');
       $table->string('action_by', 100);
       $table->string('action_on',100);
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
      Schema::dropIfExists('logs');
    }
};
