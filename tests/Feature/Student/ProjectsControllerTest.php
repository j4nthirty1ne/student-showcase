<?php

namespace Tests\Feature\Student;

use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_index_page_renders_successfully(): void
    {
        $user = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($user)->get('/student/projects');

        $response->assertStatus(200)
            ->assertSee('My Projects');
    }

    public function test_projects_create_page_renders_successfully(): void
    {
        $user = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($user)->get('/student/projects/create');

        $response->assertStatus(200)
            ->assertSee('Create Project', false);
    }
}
