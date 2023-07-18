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
            $table->foreignId('user_id')
                ->comment('User identifier number.');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('plate', 8)
                ->comment('Foodtruck vehicle license plate.');
            $table->string('foodtruck_name')
                ->comment('Foodtruck name.');
            $table->string('food')
                ->comment('Foodtruck offered food type.');
            $table->text('description')
                ->nullable()
                ->comment('Foodtruck description and/or additional information.');
            $table->timestamps();
        });
        Schema::create('foodtrucks_documents_applications', function (Blueprint $table) {
            $table->id()
                ->comment('Document identifier number.');
            $table->foreignId('foodtruck_id')
                ->comment('Foodtruck identifier number.');
            $table->foreign('foodtruck_id')
                ->references('id')
                ->on('foodtrucks')
                ->onDelete('cascade');
            $table->string('document_name')
                ->comment('Document name.');
            $table->date('expires')
                ->comment('Document expire date.');
            $table->string('file')
                ->comment('Document file name.');
            $table->boolean('approved')
                ->default(0)
                ->comment('Pending or approved.');
            $table->timestamps();
        });
        Schema::create('foodtrucks_applications', function (Blueprint $table) {
            $table->id()
                ->comment('Application identifier number.');
            $table->foreignId('event_id')
                ->comment('Event identifier number.');
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
            $table->foreignId('foodtruck_id')
                ->comment('Foodtruck identifier number.');
            $table->foreign('foodtruck_id')
                ->references('id')
                ->on('foodtrucks')
                ->onDelete('cascade');
            $table->string('food')
                ->comment('Foodtruck offered food type.');
            $table->boolean('approved')
                ->default(0)
                ->comment('Pending or approved.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodtrucks_applications');
        Schema::dropIfExists('foodtrucks_documents_applications');
        Schema::dropIfExists('foodtrucks');
    }
};