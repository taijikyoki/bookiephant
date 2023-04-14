<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        Book::factory()->count(10)->create();
        Genre::factory()->count(5)->create();
        
        $genres = Genre::get();
        
        Book::all()->each(function ($book) use ($genres) {
            $book->genres()->attach(
                $genres->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
