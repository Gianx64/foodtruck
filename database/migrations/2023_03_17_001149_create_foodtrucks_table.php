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
            $table->string('plate', 8)
                  ->comment('Foodtruck vehicle plate.');
            $table->string('owner')
                  ->comment('Foodtruck owner email.');
            $table->foreign('owner')
                  ->references('email')
                  ->on('users')
                  ->onDelete('cascade');
                  //->unique();
            $table->text('description')
                  ->nullable()
                  ->comment('Foodtruck description and additional information.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodtrucks');
    }
};