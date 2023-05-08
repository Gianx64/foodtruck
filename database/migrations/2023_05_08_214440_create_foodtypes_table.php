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
        Schema::create('foodtypes', function (Blueprint $table) {
            $table->id()
                  ->comment('Foodtype identifier number.');
            $table->string('name')
                  ->comment('Foodtype name.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodtypes');
    }
};
