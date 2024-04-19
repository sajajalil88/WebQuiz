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
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('event_id'); // Foreign key to events table
            $table->string('ticket_code')->unique(); // Unique ticket code
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Delete related tickets if a user is deleted

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade'); // Delete related tickets if an event is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['event_id']);
        });

        Schema::dropIfExists('tickets');
    }
}
