<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('comp_name')->nullable();
            $table->string('logo',100)->nullable();
            $table->string('favicon',100)->nullable();
            $table->string('email')->nullable();
            $table->string('alt_email')->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('address')->nullable();
            $table->string('city',100)->nullable();
            $table->unsignedInteger('state')->nullable();
            $table->unsignedInteger('country')->nullable();
            $table->string('pincode',20)->nullable();
            $table->string('website_url')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('map')->nullable();
            $table->string('g_recaptcha_site_key', 100)->nullable();
            $table->string('g_recaptcha_secret_key', 100)->nullable();
            $table->enum('meta_robots', [1, 0])->nullable()->default(0);
            $table->string('site_verification', 200)->nullable();
            $table->text('analytics')->nullable();
            $table->unsignedBigInteger('product_per_page')->default(50);
            $table->unsignedBigInteger('order_per_page')->default(50);
            $table->unsignedBigInteger('user_per_page')->default(50);
            $table->string('m_location')->nullable();
            $table->string('currency',50)->nullable();
            $table->string('footer_content')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
