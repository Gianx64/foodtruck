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
            $table->date('date')
                  ->comment('Event date.');
            $table->string('address')
                  ->comment('Event physical address.');
            $table->string('map')
                  ->comment('Event map image file name.');
            $table->text('description')
                  ->nullable()
                  ->comment('Event description and additional information.');
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