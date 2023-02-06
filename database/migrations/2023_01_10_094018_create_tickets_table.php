<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('ticket_type_id'); // inquiries - complaints - suggestions
            $table->unsignedBigInteger('ticket_classification_id')->nullable();
            $table->string('comments')->nullable();
            // $table->string('attachments')->nullable();
            $table->string('status')->default('open'); // open - progress - closed
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('ticket_source')->nullable();
            $table->string('request_description')->nullable();
            $table->unsignedBigInteger('back_office_id')->nullable();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types')->onDelete('cascade');
            $table->foreign('ticket_classification_id')->references('id')->on('ticket_classifications')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('back_office_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('tickets');
    }
}
