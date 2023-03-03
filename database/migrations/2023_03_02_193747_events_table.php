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
                  ->unique()
                  ->comment('Event Agency name.');
            $table->text('description')
                  ->comment('Event description.');
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
