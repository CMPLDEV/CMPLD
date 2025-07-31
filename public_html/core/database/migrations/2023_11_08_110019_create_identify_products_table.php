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
      Schema::create('identify_products', function (Blueprint $table) {
        $table->id();
        $table->string('contract_no')->nullable();
        $table->string('quantity')->nullable();
        $table->string('consignee')->nullable();
        $table->string('buyer_name')->nullable();
        $table->string('computer_model')->nullable();
        $table->string('computer_sr_no')->nullable();
        $table->string('monitor_sr_no')->nullable();
        $table->string('windows_key')->nullable();
        $table->string('keyboard_sr_no')->nullable();
        $table->text('address_contact')->nullable();
        $table->string('status')->nullable();
        $table->string('tracking_details')->nullable();
        $table->string('dispatch_date')->nullable();
        $table->string('delivery_date')->nullable();
        $table->string('pod_date')->nullable();
        $table->string('invoice_upload_date')->nullable();
        $table->string('installation_date')->nullable();
        $table->string('received_date')->nullable();
        $table->string('warranty_start_date')->nullable();
        $table->string('warranty_end_date')->nullable();
        $table->text('description')->nullable();
        $table->string('configuration')->nullable();
        $table->string('serial_no')->nullable();
        $table->string('processor')->nullable();
        $table->string('motherboard')->nullable();
        $table->string('ram')->nullable();
        $table->string('hdd')->nullable();
        $table->string('sdd')->nullable();
        $table->string('dvd_writer')->nullable();
        $table->string('graphic_card')->nullable();
        $table->string('cabinet')->nullable();
        $table->string('monitor')->nullable();
        $table->string('keyboard_mouse')->nullable();
        $table->string('os')->nullable();
        $table->string('headphone')->nullable();
        $table->string('webcam')->nullable();
        $table->string('wifi_dongle')->nullable();
        $table->string('warranty')->nullable();
        $table->string('other')->nullable();
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
     Schema::dropIfExists('identify_products');
    }
};
