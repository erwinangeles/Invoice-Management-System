<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name')->nullable();
            $table->string('business_address_street')->nullable();
            $table->string('business_address_street2')->nullable();
            $table->string('business_address_city')->nullable();
            $table->string('business_address_state')->nullable();
            $table->string('business_address_zipcode')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone_number')->nullable();
            $table->string('business_website')->nullable();
            $table->longText('header_notes')->nullable();
            $table->longText('footer_notes_left')->nullable();
            $table->longText('footer_notes_right')->nullable();
            $table->string('business_logo')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
