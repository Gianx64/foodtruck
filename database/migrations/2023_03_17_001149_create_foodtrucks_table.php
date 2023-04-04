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
        Schema::create('foodtrucks', function (Blueprint $table) {
            $table->id()
                  ->comment('Foodtruck identifier number.');
            $table->foreignId('event_id')
                  ->comment('Event identifier number.');
            $table->foreign('event_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('name')
                  ->comment('Foodtruck name.');
            $table->string('plate', 8)
                  ->comment('Foodtruck vehicle license plate.');
            $table->string('owner')
                  ->comment('Foodtruck owner email.');
            $table->string('food')
                  ->comment('Foodtruck offered food type.');
            $table->text('description')
                  ->nullable()
                  ->comment('Foodtruck description and/or additional information.');
            $table->timestamps();
        });
        Schema::create('foodtrucks_accepted', function (Blueprint $table) {
            $table->id()
                  ->comment('Foodtruck identifier number.');
            $table->foreignId('event_id')
                  ->comment('Event identifier number.');
            $table->foreign('event_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('name')
                  ->comment('Foodtruck name.');
            $table->string('plate', 8)
                  ->comment('Foodtruck vehicle license plate.');
            $table->string('owner')
                  ->comment('Foodtruck owner email.');
            $table->string('food')
                  ->comment('Foodtruck offered food type.');
            $table->text('description')
                  ->nullable()
                  ->comment('Foodtruck description and/or additional information.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodtrucks');
        Schema::dropIfExists('foodtrucks_accepted');
    }
};