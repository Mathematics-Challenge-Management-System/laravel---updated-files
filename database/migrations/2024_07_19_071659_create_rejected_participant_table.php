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
        Schema::create('rejected_participant', function (Blueprint $table) {
            $table->id('participant_id');
            $table->string('fname', 25)->nullable();
            $table->string('lname', 25)->nullable();
            $table->string('email', 50)->nullable()->unique();
            $table->string('phone', 15)->nullable();
            $table->string('schoolRegNo', 15);
            $table->string('username', 55)->unique();
            $table->string('password', 200)->nullable();
            $table->date('dob')->nullable();
            $table->binary('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rejected_participant');
    }
};
