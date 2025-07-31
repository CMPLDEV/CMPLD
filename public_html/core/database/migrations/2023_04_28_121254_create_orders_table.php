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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('gateway_order_id')->nullable();
            $table->string('gateway_payment_id')->nullable();
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('net_amount');
            $table->enum('type',['PREPAID','COD']);
            $table->enum('payment_status',['PAID','UNPAID'])->default('UNPAID');
            $table->enum('delivery_status',['PENDING','DISPATCHED','DELIVERED','SHIPPED','CANCELLED'])->default('PENDING');
            $table->string('cancel_note')->nullable();
            $table->enum('cancelled_by',['ADMIN','USER'])->default('ADMIN');
            $table->unsignedInteger('coupon')->default(0);
            $table->string('name',150)->nullable();
            $table->string('email')->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('pincode',15)->nullable();
            $table->string('city',200)->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('country');
            $table->unsignedInteger('state');
            $table->string('tracking_no')->nullable();
            $table->text('tracking_link')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
