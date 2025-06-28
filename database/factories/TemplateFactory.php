<?php

namespace Database\Factories;

use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFactory extends Factory
{
    protected $model = Template::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'author' => $this->faker->name,
            'content' => '<p>' . $this->faker->sentence(10) . '</p>',
            'repo_url' => $this->faker->url,
            'preview_url' => $this->faker->url,
            'thumbnail' => 'sample-image.jpg', // or use $this->faker->imageUrl()
            'type' => $this->faker->randomElement(['Free', 'Premium']),
            'download_count' => $this->faker->numberBetween(0, 1000),
            'star_count' => $this->faker->numberBetween(0, 500),
            'created_by' => 1, // Replace with dynamic user ID if needed
        ];
    }
}
