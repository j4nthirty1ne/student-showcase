<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'category_id' => Category::query()->inRandomOrder()->value('id') ?? Category::factory(),
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'short_description' => fake()->sentence(10),
            'description' => fake()->paragraphs(3, true),
            'url' => fake()->url(),
            'demo_link' => fake()->optional()->url(),
            'github_link' => fake()->optional()->url(),
            'cover_image' => null,
            'technologies' => ['Laravel', 'React', 'PHP'],
            'images' => [],
            'status' => 'published',
            'featured' => false,
            'published_at' => fake()->dateTimeBetween('-6 months'),
            'created_at' => fake()->dateTimeBetween('-6 months'),
            'updated_at' => fake()->dateTimeBetween('-3 months'),
        ];
    }

    /**
     * Indicate that the project should be in draft status.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the project should be completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the project should be in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
        ]);
    }

    /**
     * Indicate that the project is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }

    /**
     * Indicate that the project has view and like counts.
     */
    public function withInteractions(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }
}
