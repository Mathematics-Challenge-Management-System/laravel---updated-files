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
        Schema::create('participant', function (Blueprint $table) {
            $table->id('participant_id');
            $table->string('fname', 25);
            $table->string('lname', 25);
            $table->string('email', 50);
            $table->string('phone', 15);
            $table->string('schoolRegNo', 15);
            $table->string('password', 255);
            $table->string('username', 55)->unique();
            $table->date('dob')->nullable();
            $table->string('image', 255);
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
        Schema::dropIfExists('participant');
    }
};
