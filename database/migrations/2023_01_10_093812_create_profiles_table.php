<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('id_number')->nullable();
            $table->string('phone_number');
            $table->integer('aou_number');
            $table->string('nationality')->nullable();
            $table->string('email');
            $table->unsignedBigInteger('college_name');
            $table->unsignedBigInteger('specialization');
            $table->unsignedBigInteger('branch_name');
            $table->string('language');
            $table->timestamps();

            $table->foreign('college_name')->references('id')->on('colleges')->onDelete('cascade');
            $table->foreign('specialization')->references('id')->on('specializations')->onDelete('cascade');
            $table->foreign('branch_name')->references('id')->on('branches')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
