<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Template;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a single test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'username' => 'testuser',
            'password' => bcrypt('password'),
            'email' => 'test@example.com',
        ]);

        // Create 1 template associated with that user
        Template::factory()->create([
            'title' => 'Sample Template',
            'description' => 'This is a sample template description.',
            'author' => $user->name,
            'content' => '<p>This is the content of the sample template.</p>',
            'thumbnail' => 'image.png', // Ensure this exists in public/storage
            'type' => 'Free',
            'repo_url' => 'https://github.com/BhailaBigyan/portfolio',
            'preview_url' => 'https://bhailabigyan.github.io/portfolio/',
            'created_by' => $user->id,
        ]);
        Template::factory()->create([
            'title' => 'Sample Template',
            'description' => 'This is a sample template description.',
            'author' => $user->name,
            'content' => '<p>This is the content of the sample template.</p>',
            'thumbnail' => 'image.png', // Ensure this exists in public/storage
            'type' => 'Free',
            'repo_url' => 'https://github.com/BhailaBigyan/portfolio',
            'preview_url' => 'https://bhailabigyan.github.io/portfolio/',
            'created_by' => $user->id,
        ]);
        Template::factory()->create([
            'title' => 'Sample Template',
            'description' => 'This is a sample template description.',
            'author' => $user->name,
            'content' => '<p>This is the content of the sample template.</p>',
            'thumbnail' => 'image.png', // Ensure this exists in public/storage
            'type' => 'Free',
            'repo_url' => 'https://github.com/BhailaBigyan/portfolio',
            'preview_url' => 'https://bhailabigyan.github.io/portfolio/',
            'created_by' => $user->id,
        ]);
        Template::factory()->create([
            'title' => 'Sample Template',
            'description' => 'This is a sample template description.',
            'author' => $user->name,
            'content' => '<p>This is the content of the sample template.</p>',
            'thumbnail' => 'image.png', // Ensure this exists in public/storage
            'type' => 'Free',
            'repo_url' => 'https://github.com/BhailaBigyan/portfolio',
            'preview_url' => 'https://bhailabigyan.github.io/portfolio/',
            'created_by' => $user->id,
        ]);
        Template::factory()->create([
            'title' => 'Sample Template',
            'description' => 'This is a sample template description.',
            'author' => $user->name,
            'content' => '<p>This is the content of the sample template.</p>',
            'thumbnail' => 'image.png', // Ensure this exists in public/storage
            'type' => 'Free',
            'repo_url' => 'https://github.com/BhailaBigyan/portfolio',
            'preview_url' => 'https://bhailabigyan.github.io/portfolio/',
            'created_by' => $user->id,
        ]);
        Template::factory()->create([
            'title' => 'Sample Template',
            'description' => 'This is a sample template description.',
            'author' => $user->name,
            'content' => '<p>This is the content of the sample template.</p>',
            'thumbnail' => 'image.png', // Ensure this exists in public/storage
            'type' => 'Free',
            'repo_url' => 'https://github.com/BhailaBigyan/portfolio',
            'preview_url' => 'https://bhailabigyan.github.io/portfolio/',
            'created_by' => $user->id,
        ]);
    }
}
