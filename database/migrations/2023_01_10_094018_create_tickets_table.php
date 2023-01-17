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
            $table->id();
            $table->integer('profile_id');
            $table->string('ticket_type_id'); // inquiries - complaints - suggestions
            $table->string('ticket_classification_id')->nullable();
            $table->string('comments')->nullable();
            // $table->string('attachments')->nullable();
            $table->string('status')->default('open'); // open - progress - closed
            $table->integer('agent_id')->nullable();
            $table->string('ticket_source')->nullable();
            $table->string('request_description')->nullable();
            $table->integer('back_office_id')->nullable();

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
