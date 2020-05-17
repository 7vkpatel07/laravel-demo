<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('passport_id')->nullable()->after('social_id_number');
            $table->string('address_city_en')->nullable()->after('address_city');
            $table->string('birth_date')->nullable()->after('phone');
            $table->integer('country_id')->nullable()->after('address_zip');
            $table->string('country_code')->nullable()->after('country_id');
            $table->integer('status')->nullable()->after('language_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
