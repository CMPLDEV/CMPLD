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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('item_id')->index();
            $table->string('item_name');
            $table->string('item_sku',200);
            $table->unsignedInteger('item_qty');
            $table->unsignedInteger('item_unit_price');
            $table->unsignedInteger('item_net_price');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
        $table->dropForeign('order_details_order_id_foreign');
        $table->dropIndex('order_details_order_id_index');
        $table->dropColumn('order_id');
    }
};
