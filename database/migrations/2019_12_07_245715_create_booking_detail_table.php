<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_detail', function (Blueprint $table) {
            $table->bigIncrements('booking_detail_id');
            $table->bigInteger('booking_id')->unsigned();
            $table->foreign('booking_id')->references('booking_id')->on('booking');
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('package_id')->on('package');
            $table->date('event_date');
            $table->string('booking_detail_description', 255)->default('');
            $table->boolean('booking_detail_is_confirmed')->default(false);
            $table->boolean('booking_detail_is_paid')->default(false);
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
        Schema::dropIfExists('booking_detail');
    }
}
