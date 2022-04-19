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
        Schema::create('registrations', function (BluePrint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('student_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade');
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
        Schema::table('registrations', function (BluePrint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['course_id']);
        });
        Schema::dropIfExists('registrations');
    }
};
