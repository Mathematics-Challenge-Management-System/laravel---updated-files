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
        Schema::create('table_schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('school_district');
            $table->string('school_regNo')-> unique();
            $table->string('rep_name')-> unique();
            $table->string('email')-> unique();
            $table->string('representative_password');
            $table->integer('school_phone');

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
        Schema::dropIfExists('table_schools');
    }
};
