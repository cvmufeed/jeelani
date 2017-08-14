<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index()->comment('added_by');
            $table->smallInteger('type')->default(0)->comment('0:sms');
            $table->text('content');
            $table->integer('destination_no')->unsigned();
            $table->integer('destination_email')->unsigned();
            $table->smallInteger('status')->default(0)->comment("0:added;1:sent;2:failed;3:cancelled");
            $table->softDeletes();
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
        Schema::drop('notifications');
    }
}
