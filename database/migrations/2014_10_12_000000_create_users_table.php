<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('mobile_phone')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->longText('user_token')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_street_number')->nullable();
            $table->string('address_zip')->nullable();
            $table->string('fax')->nullable();
            $table->string('social_id_number')->nullable();
            $table->string('profile_photo')->nullable();
            $table->timestamp('last_active_date_time')->nullable();
            $table->integer('is_superadmin');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
