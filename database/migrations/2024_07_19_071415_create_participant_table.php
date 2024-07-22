<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('participant', function (Blueprint $table) {
            $table->id('participant_id');
            $table->string('fname', 25);
            $table->string('lname', 25);
            $table->string('email', 50);
            $table->string('schoolRegNo', 15);
            $table->string('password', 255);
            $table->string('username', 55)->unique();
            $table->date('dob')->nullable();
            // The image column will be added after the table is created
        });

        // Adding the image column as longblob after creating the table
        DB::statement("ALTER TABLE participant ADD image LONGBLOB ");
    }

    public function down()
    {
        Schema::dropIfExists('participant');
    }
};
