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
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_id');
            $table->enum('status',['APPLIED','USED']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_coupons');

        $table->dropForeign('user_coupons_user_id_foreign');
        $table->dropIndex('user_coupons_user_id_index');
        $table->dropColumn('user_id');

        $table->dropForeign('user_coupons_coupon_id_foreign');
        $table->dropIndex('user_coupons_coupon_id_index');
        $table->dropColumn('coupon_id');
    }
};
