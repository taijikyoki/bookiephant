<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Genre;
use App\Enum\BookPublicationType;

class BookFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'title' => fake()->word,
            'description' => fake()->sentence,
            'release_year' => fake()->year,
            'publishing_type' => fake()->randomElement(array_column(BookPublicationType::cases(), 'value')),
            'author_id' => Author::factory()->create(),
        ];
    }
}
