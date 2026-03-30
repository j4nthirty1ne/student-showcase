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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title', 150)->index();
            $table->string('slug', 180)->unique()->nullable();
            $table->string('short_description', 255)->nullable();
            $table->text('description');
            $table->jsonb('tech_stack')->nullable();
            $table->string('github_link', 255)->nullable();
            $table->string('demo_link', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->enum('status', ['draft', 'published'])->default('published')->index();
            $table->boolean('featured')->default(false)->index();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
