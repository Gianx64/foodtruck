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
        Schema::create('users', function (Blueprint $table) {
            $table->id()
                ->comment('User identifier number.');
            $table->string('name')
                ->comment('User name.');
            $table->string('email')
                ->unique()
                ->comment('User electronic mail address.');
            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('Timestamp of user email confirmation.');
            $table->string('password')
                ->comment('User login password.');
            $table->rememberToken()
                ->comment('User login "remember me" token.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
