<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        Book::factory()->count(5)->create();
        Genre::factory()->count(5)->create();
        
        $genres = Genre::get();
        
        Book::all()->each(function ($book) use ($genres) {
            $book->genres()->attach(
                $genres->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

        $admin = new Role();
        $admin->name = 'Adminitrator';
        $admin->slug = 'admin';
        $admin->save();

        $author = new Role();
        $author->name = 'Author';
        $author->slug = 'author';
        $author->save();

        $adminUser = new User();
        $adminUser->name = 'Administrator';
        $adminUser->email = 'admin';
        $adminUser->password = Hash::make('admin');
        $adminUser->save();

        $adminUser->addRole('admin');
    }
}
