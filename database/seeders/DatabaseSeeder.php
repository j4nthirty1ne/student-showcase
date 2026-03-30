<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'Web Development', 'Mobile Development', 'AI', 'Networking', 
            'Cybersecurity', 'Database System'
        ];
        foreach ($categories as $cat) {
            \App\Models\Category::firstOrCreate(['name' => $cat]);
        }

        $technologies = [
            'PHP', 'Laravel', 'MySQL', 'JavaScript', 'Tailwind CSS', 
            'HTML', 'CSS', 'Python', 'Docker', 'Git', 'Bootstrap'
        ];
        foreach ($technologies as $tech) {
            \App\Models\Technology::firstOrCreate(['name' => $tech]);
        }

        User::firstOrCreate(
            ['email' => 'admin@student-showcase.com'],
            [
                'name' => 'System Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'bio' => 'Platform administrator',
                'skills' => 'System Management, Moderation',
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'student@student-showcase.com'],
            [
                'name' => 'Demo Student',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'bio' => 'Passionate IT student building web projects.',
                'skills' => 'Laravel, PHP, MySQL, Tailwind CSS',
                'role' => 'student'
            ]
        );

        \App\Models\Project::factory(10)->create();
    }
}
