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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->char('reason', 100); /*--> The reason for the appointment*/
            $table->dateTime('begin'); /*--> The date of the appointment*/
            $table->dateTime('end'); /*--> The date of the appointment*/
            $table->unsignedBigInteger('session'); /*--> The session of the user*/
            $table->char('color',10)->default('#1ABC9C'); /*--> The id of the */
            $table->char('textColor',10)->default('#000000'); /*--> The id of the */
             $table->unsignedBigInteger('user_id'); /*--> The user of the appointment*/
            $table->unsignedBigInteger('booked_by');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('appointments');
    }
};
