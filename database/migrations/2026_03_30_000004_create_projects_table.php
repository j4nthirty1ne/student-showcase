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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->string('title', 150)->index('idx_projects_title');
            $table->string('slug', 180)->nullable()->unique();
            $table->string('short_description', 255)->nullable();
            $table->text('description');

            $table->string('github_link')->nullable();
            $table->string('demo_link')->nullable();
            $table->string('cover_image')->nullable();

            $table->enum('status', ['draft', 'published'])->default('published')->index('idx_projects_status');
            $table->boolean('featured')->default(false)->index('idx_projects_featured');

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
