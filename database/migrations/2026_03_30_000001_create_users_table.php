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
            $table->id();
            $table->string('name', 100)->index('idx_users_name');
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->text('skills')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('role', ['student', 'admin'])->default('student')->index('idx_users_role');
            $table->boolean('is_active')->default(true);
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
