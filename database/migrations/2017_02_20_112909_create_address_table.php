<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->integer('pin')->unsigned();
            $table->string('phone');
            $table->string('city');
            $table->integer('district_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('start_month');
            $table->integer('start_year');
            $table->integer('end_month');
            $table->integer('end_year');
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
        Schema::drop('addresses');

        /*Schema::table('addresses', function ($table) {
            $table->dropColumn('landmark');
            $table->dropColumn('post_name');
        });*/
    }
}
