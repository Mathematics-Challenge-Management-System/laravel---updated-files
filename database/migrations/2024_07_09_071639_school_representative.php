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
        Schema::create('school_representative', function (Blueprint $school_representative) {
            $school_representative->string('school_name', 50);
            $school_representative->string('school_regNo', 15)->primary();
            $school_representative->string('school_district', 50);
            $school_representative->string('rep_fname', 25);
            $school_representative->string('rep_lname', 25);
            $school_representative->string('rep_email', 50);
            $school_representative->unsignedBigInteger('admin_id')->nullable();


            // Define foreign key
            $school_representative->foreign('admin_id')->references('id')->on('admin');
        });
        Schema::table('school_representative', function (Blueprint $table) {
            $table->dropColumn(['school_address', 'updated_at', 'created_at']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_representative');
    }
};
