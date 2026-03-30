<?php

namespace Database\Factories;

use App\Models\Project;
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
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(3, true),
            'tech_stack' => json_encode($this->faker->randomElements(['PHP', 'Laravel', 'React', 'Vue', 'Node.js', 'PostgreSQL', 'Tailwind CSS', 'Docker'], rand(2, 4))),
            'github_link' => $this->faker->url(),
            'demo_link' => $this->faker->url(),
            'thumbnail' => $this->faker->imageUrl(800, 600, 'tech'),
            'status' => 'published',
            'featured' => $this->faker->boolean(20),
            'published_at' => now(),
        ];
    }
}
