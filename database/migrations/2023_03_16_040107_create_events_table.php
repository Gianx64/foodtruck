<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id()
                  ->comment('Event identifier number.');
            $table->string('name')
                  ->comment('Event name.');
            $table->string('owner')
                  ->comment('Event administrator email.');
            $table->foreign('owner')
                  ->references('email')
                  ->on('users')
                  ->onDelete('cascade');
            $table->dateTime('date')
                  ->comment('Event date and time.');
            $table->string('address')
                  ->comment('Event physical address.');
            $table->unsignedTinyInteger('slots')
                  ->comment('Ammount of event room for foodtrucks.');
            $table->string('documents')
                  ->nullable()
                  ->comment('Required approved documents for foodtrucks.');
            $table->text('description')
                  ->nullable()
                  ->comment('Event description and additional information.');
            $table->string('map')
                  ->comment('Event map image file name.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};